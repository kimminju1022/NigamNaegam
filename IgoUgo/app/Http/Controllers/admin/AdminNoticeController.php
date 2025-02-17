<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Board;
use App\Models\BoardImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use MyToken;
use Throwable;

class AdminNoticeController extends Controller
{
    // 공지사항 리스트
    public function index() {
        $notice = Board::select(DB::raw("*, DATE_FORMAT(created_at, '%Y-%m-%d %H:%i:%s') as created_at_timestamps"))
                        ->with('user', function ($query) {
                            $query->withTrashed();
                        })
                        ->where('bc_code', '5')
                        ->where('board_flg', '0')
                        ->orderBy('created_at','DESC')
                        ->paginate(17);

        $responseData = [
        'success' => true
        ,'msg' =>'게시글 리스트 획득 성공'
        ,'data' => $notice->toArray()
        ];

        return response()->json($responseData, 200);
    }

    // 공지사항 디테일
    public function show($id) {
        $notice= Board::select(DB::raw("*, DATE_FORMAT(updated_at, '%Y-%m-%d %H:%i:%s') as updated_at_timestamps"))
                        ->with(['user'=> function ($query) {
                            $query->withTrashed();
                        }, 'board_images'])
                        ->where('board_id', $id)
                        ->first();

        $responseData = [
            'success' => true
            ,'msg' =>'게시글 획득 성공'
            ,'data' => $notice->toArray()
        ];
        return response()->json($responseData, 200);
    }

    // 공지사항 작성
    public function store(Request $request) {
        try {
            DB::beginTransaction();
            Log::debug('rr', $request->toArray());
            Log::debug($request->board_img);
            $insertData = $request->only('board_title','board_content');
            $insertData['user_id'] = MyToken::getValueInPayload($request->bearerToken(), 'idt');
            $insertData['view_cnt'] = 0;
            $insertData['bc_code'] = '5';

            $board = Board::create($insertData);

            Log::debug('bb', $board->toArray());
            // 이미지 저장
            if($request->hasFile('board_img')) {
                foreach ($request->board_img as $file) {
                    $path = '/'.$file->store('img');
                    BoardImage::create([
                        'board_id' => $board->board_id,
                        'board_img' => $path,
                    ]);
                    // Log::debug('Image path:', $path->toArray());
                }
            }

            $responseData = [
                'success' => true
                ,'msg' => '게시글 작성 성공'
                ,'data' => $board->toArray()
            ];
            DB::commit();
            
            return response()->json($responseData, 200);
        } catch(Throwable $th){
            DB::rollBack();
            $th->getMessage();
        }
    }

    // 게시글 수정 처리
    public function update(Request $request) {
        try {
            DB::beginTransaction();

            Log::debug($request);
            
            $board = Board::find($request->board_id);
            // Log::debug($board);
            // Log::debug($request->user_id);
            // Log::debug($board->user_id);

            if($board->user_id !== $request->user_id) {
                $board->user_id = $request->user_id;
            }
            if($board->board_title !== $request->board_title) {
                $board->board_title = $request->board_title;
            }
            if($board->board_content !== $request->board_content) {
                $board->board_content = $request->board_content;
            }
    
            $board->save();

            $boardImg = BoardImage::where('board_id', $request->board_id)->get();

            // 이미 있던 이미지 request
            if ($request->has('board_img_path')) {
                foreach ($boardImg as $image) {
                    // 현재 board_img가 request에 없으면 softDelete
                    if (!in_array($image->board_img, $request->board_img_path)) {
                        $image->deleted_at = now();
                        $image->save();
                    }
                }
            } else {
                foreach ($boardImg as $image) {
                    $image->deleted_at = now();
                    $image->save();
                }
            }

            // 새로 추가한 이미지 request
            if ($request->has('board_img_file')) {
                foreach ($request->board_img_file as $file) {
                    $path = '/'.$file->store('img');
                    BoardImage::create([
                        'board_id' => $request->board_id
                        ,'board_img' => $path
                        ,'deleted_at' => null,      
                    ]);
                }
            }
    
            DB::commit();

            $responseData = [
                'success' => true
                ,'msg' => '게시글 업데이트 성공'
                ,'data' => $board->toArray()
                ,'board_img' => $boardImg->toArray()
            ];
        } catch(Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return response()->json($responseData, 200);
    }

    // 게시글 삭제
    public function destroy($id) {
        Log::debug($id);
        $board = Board::where('board_id', $id)
                        ->first();

        // $board->delete();
        $board->board_flg = '1';
        $board->save(); 
        
        $board_img = BoardImage::with('board')
                                ->where('board_id', $id)
                                ->get();
        // if($board_img) {
        //     $board_img->delete();
        // }
        if($board_img->isNotEmpty()) {
            $board_img->each(function($img) {
                $img->delete();
            });
        }

        $responseData = [
            'success' => true
            ,'msg' => '게시글 삭제 성공'
        ];

        return response()->json($responseData, 200);
    }
}
