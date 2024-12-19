<?php

namespace App\Http\Controllers;

use App\Models\BoardsCategory;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    //actionMethod
    public function index(){
        $boardList = BoardsCategory::orderBy('created_at','DESC')->paginate(15);

        $responseData = [
            'success' => true,'msg' =>'게시글획득성공'
            ,'boardList' => $boardList->toArray()
        ];
        return response()->json($responseData, 200);
    }
}
