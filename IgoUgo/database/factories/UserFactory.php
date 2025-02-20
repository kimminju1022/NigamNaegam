<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $create_date = $this->faker->dateTimeBetween('-3 year');
        $update_date = $this->faker->dateTimeBetween('-3 year'); // 250101
        $six_months = Carbon::now()->subMonths(6); // 240727
        $out = rand(0,1);
        $flg = rand(0,1);
        $date = Carbon::now();
        $name = $this->faker->name();

        // $update_date = $this->faker->dateTimeBetween('-3 years', '-2.5 years');

        // 강퇴인 경우
        if($out === 1) {
            $flg = 1; // 당연히 삭제플래그 1되어야함

            // updated_at이 6개월 이전인 경우 -> 삭제처리
            if($update_date <= $six_months) { 
                $deleted_date = $update_date;
            } else {
                $deleted_date = null;
            }
        } else if ($out === 0) {
            // 자발적 탈퇴인 경우
            if($flg === 1) {
                // updated_at이 6개월 이전인 경우 -> 삭제처리
                if($update_date <= $six_months) {
                    $deleted_date = $update_date;
                } else {
                    $deleted_date = null;
                }
            } 
            // 탈퇴 안함
            else if ($flg === 0) {
                $deleted_date = null;
            }
        }


        // return [
        //     'user_out' => $out
        //     ,'user_flg' => $flg
        //     ,'user_email' => $this->faker->unique()->safeEmail()
        //     ,'user_password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
        //     ,'user_name' => $this->faker->name()
        //     ,'user_nickname' => $this->faker->unique()->name()
        //     ,'user_phone' => '0' . $this->faker->randomElement(['10', '11', '17']) . $this->faker->numerify('########')
        //     // ,'refresh_token' => Str::random(10)
        //     ,'email_verified_at'=> $create_date
        //     ,'user_last_login'=> $create_date
        //     // ,'password_reset_token'=> null
        //     // ,'password_reset_expires_at'=> null
        //     ,'created_at' => $create_date
        //     ,'updated_at' => $update_date
        //     ,'deleted_at' => $deleted_date
        // ];
        return [
            'user_out' => $out
            ,'user_flg' => $flg
            ,'user_email' => $this->faker->unique()->safeEmail()
            ,'user_password' => Hash::make('qwer1234!')
            ,'user_name' => $name
            ,'user_nickname' => $name
            ,'user_phone' => '0' . $this->faker->randomElement(['10']) . $this->faker->numerify('########')
            // ,'refresh_token' => Str::random(10)
            ,'email_verified_at'=> $date
            ,'user_last_login'=> $date
            // ,'password_reset_token'=> null
            // ,'password_reset_expires_at'=> null
            ,'created_at' => $date
            ,'updated_at' => $date
            ,'deleted_at' => null
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
