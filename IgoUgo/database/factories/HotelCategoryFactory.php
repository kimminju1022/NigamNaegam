<?php

namespace Database\Factories;

use App\Models\HotelCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HotelCategory>
 */
class HotelCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // HotelCategory::insert([
        //     ['hc_type' => '0', 'hc_name' => '수영장']
        //     ,['hc_type' => '1', 'hc_name' => '바베큐장']
        //     ,['hc_type' => '1', 'hc_name' => '캠프파이어']
        //     ,['hc_type' => '1', 'hc_name' => '뷰티시설']
        //     ,['hc_type' => '1', 'hc_name' => '피트니스센터']
        //     ,['hc_type' => '1', 'hc_name' => '픽업서비스']
        // ]);
    }
}
