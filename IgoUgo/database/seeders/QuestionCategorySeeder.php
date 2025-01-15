<?php

namespace Database\Seeders;

use App\Models\Board;
use App\Models\QuestionCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $boards = Board::select('board_id')->where('bc_code', '2')->get();

        foreach($boards as $item) {
            $question_category = new QuestionCategory();
            $code = rand(0,8);
            $name = ['로그인', '회원가입', '게시판', '호텔', '관광지', '문화시설', '레포츠', '쇼핑', '음식점'];

            $question_category->board_id = $item->board_id;
            $question_category->qc_code = $code;
            $question_category->qc_name = $name[$code];

            $question_category->timestamps = false;
            $question_category->save();
        }
    }
}
