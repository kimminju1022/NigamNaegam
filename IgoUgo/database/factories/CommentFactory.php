<?php

namespace Database\Factories;

use App\Models\Board;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Log;

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

        $user = User::select('user_id', 'created_at')->inRandomOrder()->first();
        $board = Board::select('board_id', 'created_at')->whereIn('bc_code', ['0', '1', '3', '4', '5'])->inRandomOrder()->first(); // 문의게시판 빼고 다 댓글씀
        
        $startDate = max($board->created_at, $user->created_at);
        $date = $this->faker->dateTimeBetween($startDate, now());
        
        $comment_flg = rand(0,1);
        $flg_date = Carbon::now()->subMonths(6);

        if($comment_flg === 1) {
            if(Carbon::parse($date)->lt($flg_date)) {
                $update = Carbon::parse($date)->addMonths(6);
            } else {
                $update = $date;
            }
        } else if($comment_flg === 0) {
            $update = $date;
        }

        return [
            'user_id' => $user->user_id,
            'board_id' => $board->board_id,
            'comment_flg' => $comment_flg,
            'comment_content' => $this->faker->realText(rand(10, 200)),
            'created_at' => $date,
            'updated_at' => $update,
            'deleted_at' => $update === $date ? null : $update
        ];
    }
}
