<?php

namespace Database\Factories;

use App\Models\BoardCategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Board>
 */
class BoardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = User::select('user_id', 'created_at')->inRandomOrder()->first();
        // $bc_type = BoardCategory::select('bc_type')->inRandomOrder()->first();
        $bc_code = BoardCategory::select('bc_code')->inRandomOrder()->first();

        $date = $this->faker->dateTimeBetween($user->created_at, now());

        $board_flg = Carbon::now()->subMonths(6);

        if(Carbon::parse($date)->lt($board_flg)) {
            $update = Carbon::parse($date)->addMonths(6);
        } else {
            $update = $date;
        }

        return [
            'user_id' => $user->user_id
            ,'board_flg' => rand(0,1)
            // ,'bc_type' => $bc_type->bc_type
            ,'bc_code' => $bc_code->bc_code
            ,'board_title' => $this->faker->realText(rand(10, 100))
            ,'board_content' => $this->faker->realText(rand(10, 2000))
            // ,'board_img1' => '/img_main/back'.rand(1,5).'.jpg'
            // ,'board_img2' => '/img_main/back'.rand(1,5).'.jpg'
            ,'view_cnt' => rand(1,300)
            ,'created_at' => $date
            ,'updated_at' => $update
            ,'deleted_at' => $update === $date ? null : $update
        ];
    }
}
