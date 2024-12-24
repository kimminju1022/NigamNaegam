<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
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


        $date = $this->faker->dateTimeBetween('-1 years');

        return [
            'user_email' => $this->faker->unique()->safeEmail()
            ,'user_password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ,'user_name' => $this->faker->name()
            ,'user_nickname' => $this->faker->unique()->name()
            // ,'user_phone' => $this->faker->unique()->phoneNumber()
            ,'user_phone' => '0' . $this->faker->randomElement(['10', '11', '17']) . $this->faker->numerify('########')
            ,'refresh_token' => Str::random(10)
            ,'created_at' => $date
            ,'updated_at' => $date
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
