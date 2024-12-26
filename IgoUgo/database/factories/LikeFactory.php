<?php

namespace Database\Factories;

use App\Models\Board;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Like>
 */
class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = User::select('user_id')->inRandomOrder()->first();
        $board = Board::select('board_id')->where('bc_type', '0')->orWhere('bc_type', '1')->inRandomOrder()->first();  // bc_type 0,1만 들고와야해
        
        return [
            'board_id' => $board->board_id
            ,'user_id' => $user->user_id
            ,'like_flg' => rand(0,1)
        ];
    }
}
