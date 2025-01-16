<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notice>
 */
class NoticeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = User::select('user_id', 'created_at')->where('manager_flg', '1')->inRandomOrder()->first();
        $notice_flg = rand(0,1);
        
        $date = $this->faker->dateTimeBetween($user->created_at, now());

        $flg_date = Carbon::now()->subMonths(6);

        if($notice_flg === 1) {
            if(Carbon::parse($date)->lt($flg_date)) {
                $update = Carbon::parse($date)->addMonths(6);
            } else {
                $update = $date;
            }
        } else if($notice_flg === 0) {
            $update = $date;
        }

        return [
            'user_id' => $user->user_id,
            'notice_flg' => $notice_flg,
            'notice_title' => $this->faker->realText(rand(10, 100)),
            'notice_content' => $this->faker->realText(rand(10, 2000)),
            'created_at' => $date,
            'updated_at' => $update,
            'deleted_at' => $update === $date ? null : $update,
        ];
    }
}
