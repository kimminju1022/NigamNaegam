<?php

namespace Database\Factories;

use App\Models\Board;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

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
        $arr =['답변대기', '답변완료']; 
        $board = Board::select('board_id')->inRandomOrder()->first();
        $date = $this->faker->dateTimeBetween($board->created_at);

        return [
            'board_id' => $board->board_id
            ,'que_content' => $this->faker->realText(rand(10, 100))
            ,'que_status' => Arr::random($arr)
            ,'created_at' => $date
            ,'updated_at' => $date
        ];
    }
}
