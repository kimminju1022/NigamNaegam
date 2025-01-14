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
        // $board = Board::select('board_id', 'created_at')->where('bc_type', '0')->orWhere('bc_type', '1')->inRandomOrder()->first(); // bc_type 0,1만 들고와야해
        $board = Board::select('board_id', 'created_at')->where('bc_code', '0')->orWhere('bc_code', '1')->inRandomOrder()->first(); // bc_type 0,1만 들고와야해
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
