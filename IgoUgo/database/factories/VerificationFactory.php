<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Verification>
 */
class VerificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // $date = $this->faker->dateTimeBetween('-1 year');

        // return [
        //     'user_email' => $this->faker->unique()->safeEmail()
        //     ,'hash_email' => sha1('user_email')
        //     ,'email_verified_at'=> $date
        //     ,'created_at' => $date
        //     ,'updated_at' => $date
        // ];
    }
}
