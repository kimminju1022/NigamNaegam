<?php

namespace Database\Factories;

use App\Models\Board;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = User::select('user_id')->inRandomOrder()->first();
        $board = Board::select('board_id')->inRandomOrder()->first();
        $date = $this->faker->dateTimeBetween($board->created_at);

        return [
            'user_id' => $user->user_id,
            'board_id' => $board->board_id,
            'comment_content' => $this->faker->realText(rand(10, 200)),
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
