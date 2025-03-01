<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BoardImage;
use App\Models\TesterManagement;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Throwable;
use MyToken;


class AdminTesterController extends Controller
{
    // 관리자 체험단 리스트
    public function index() {
        $testerList = Board::select(DB::raw("*, DATE_FORMAT(created_at, '%Y-%m-%d %H:%i') as created_at_timestamps"))
                                ->with(['tester_management' => function ($query) {
                                    $query->select(DB::raw("*, DATE_FORMAT(due_date, '%Y-%m-%d') as dd"));
                                }, 
                                // 'comments' => function($query) {
                                //     $query->orderBy('created_at', 'desc');
                                // }, 
                                'board_images', 'user'])
                                ->where('bc_code', '3')
                                ->where('board_flg', '0')
                                ->withCount('comments')
                                ->orderBy('created_at','DESC')
                                ->paginate(17);

        $responseData = [
            'success' => true
            ,'msg' =>'게시글 리스트 획득 성공'
            ,'data' => $testerList->toArray()
        ];
        return response()->json($responseData, 200);
    }

    // 관리자 체험단 디테일
    public function show($id) {
        $tester = Board::with(['tester_management' => function ($query) {
                            $query->select(DB::raw("*, DATE_FORMAT(created_at, '%Y-%m-%d %H:%i:%s') as formatted_created_at
                                                    , DATE_FORMAT(updated_at, '%Y-%m-%d %H:%i:%s') as formatted_updated_at
                                                    , DATE_FORMAT(due_date, '%Y-%m-%d') as dd"));
                            }, 'comments' => function($query) {
                                $query->orderBy('created_at', 'desc');
                            }, 'user', 'board_images'])
                        ->where('board_id', $id)
                        ->first();
                        
        $responseData = [
            'success' => true
            ,'msg' =>'게시글 획득 성공'
            ,'data' => $tester->toArray()
        ];
        return response()->json($responseData, 200);
    }
    
    // 관리자 체험단 작성
    public function store(Request $request) {
        try {
            DB::beginTransaction();

            $insertData = $request->only('board_title','board_content');
            $insertData['user_id'] = MyToken::getValueInPayload($request->bearerToken(), 'idt');
            $insertData['view_cnt'] = 0;
            $insertData['bc_code'] = '3';

            $board = Board::create($insertData);

            // 이미지 저장
            if($request->hasFile('board_img')) {
                foreach ($request->board_img as $file) {
                    $path = '/'.$file->store('img');
                    BoardImage::create([
                        'board_id' => $board->board_id,
                        'board_img' => $path,
                    ]);
                }
            }

            // 체험단 장소 관리
            $insertTester['board_id'] = $board->board_id;
            $insertTester['tester_place'] = $request->tester_place;
            $insertTester['tester_area'] = $request->tester_area;
            $insertTester['tester_code'] = $request->tester_code;
            $insertTester['tester_name'] = $request->tester_name;
            $insertTester['due_date'] = Carbon::parse($request->due_date.' 23:59:59')->format('Y-m-d H:i:s');

            $testerManagement = TesterManagement::create($insertTester);

            $responseData = [
                'success' => true
                ,'msg' => '게시글 작성 성공'
                ,'board' => $board->toArray()
                ,'tester' => $testerManagement->toArray()
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
            // Log::debug('수정 시작');
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

            $tester = TesterManagement::where('board_id',$request->board_id)->first();
    
            if($tester->tester_place !== $request->tester_place) {
                $tester->tester_place = $request->tester_place;
            } 
            if($tester->tester_area !== $request->tester_area) {
                $tester->tester_area = $request->tester_area;
            } 
    
            if($tester->tester_code !== $request->tester_code) {
                $tester->tester_code = $request->tester_code;
            } 
    
            if($tester->tester_name !== $request->tester_name) {
                $tester->tester_name = $request->tester_name;
            } 
    
            if($tester->due_date !== $request->due_date) {
                $tester->due_date = Carbon::parse($request->due_date.' 23:59:59')->format('Y-m-d H:i:s');
            } 
    
            $tester->save();
    
            DB::commit();

            $responseData = [
                'success' => true
                ,'msg' => '게시글 업데이트 성공'
                ,'board' => $board->toArray()
                ,'board_img' => $boardImg->toArray()
                ,'tester' => $tester->toArray()
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
                                ->first();
                
        $board_img->delete();
        
        $tester = TesterManagement::where('board_id', $id)
                                    ->first();

        $tester->delete();

        $responseData = [
            'success' => true
            ,'msg' => '게시글 삭제 성공'
        ];

        return response()->json($responseData, 200);
    }
}
