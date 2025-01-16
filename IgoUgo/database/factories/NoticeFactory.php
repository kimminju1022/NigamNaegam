<?php

namespace Database\Factories;

use App\Models\User;
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
        $user = User::select('user_id')->where('manager_flg', '1')->inRandomOrder()->first();
        $date = $this->faker->dateTimeBetween('-1 year');

        return [
            'user_id' => $user->user_id,
            'notice_title' => $this->faker->realText(rand(10, 100)),
            'notice_content' => $this->faker->realText(rand(10, 2000)),
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
