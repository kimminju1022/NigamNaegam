<?php

namespace Database\Factories;

use App\Models\Board;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        $board = Board::select('board_id')->inRandomOrder()->first();

        return [
            'board_id' => $board->board_id,
            'que_content' => $this->faker->realText(rand(10, 100)),
            'que_status' => rand(),
        ];
    }
}
