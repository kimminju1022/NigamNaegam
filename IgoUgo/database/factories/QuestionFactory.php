<?php

namespace Database\Factories;

use App\Models\Board;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // $board = Board::select('board_id')->where('bc_type', '2')->inRandomOrder()->first(); // bc_type 2만 들고와야해
        // $board = Board::select('board_id')->where('bc_type', '2')->get(); // bc_type 2만 들고와야해
        // $board_1 = $board->offset(150)->get();
        // $board_1 = $board->take(50)->get();

        $board = Board::select('board_id')->where('bc_type', '2')
        ->whereNotExists(function($query) {
            $query->select(DB::raw(1))
                    ->from('questions')
                    ->whereRaw('boards.board_id = questions.board_id');
        })
        ->inRandomOrder()->first();

        $date = $this->faker->dateTimeBetween($board->created_at);
        // 디폴트 status = 0(답변대기)이니까 2/3정도만 1(완료)로 만드려면 150개정도만 배열로 따로 저장해서 그거만 돌려야함

        return [
            'board_id' => $board->board_id
            ,'que_content' => $this->faker->realText(rand(10, 2000))
            ,'que_status' => (string)random_int(0, 1)
            ,'created_at' => $date
            ,'updated_at' => $date
        ];
    }
}
