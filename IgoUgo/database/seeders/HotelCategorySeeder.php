<?php

namespace Database\Seeders;

use App\Models\Hotel;
use App\Models\HotelCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $hotel = Hotel::select('hotel_id')->inRandomOrder()->first();

        HotelCategory::insert([
            // ['hc_type' => '0', 'hc_name' => '수영장']
            // ,['hc_type' => '1', 'hc_name' => '바베큐장']
            // ,['hc_type' => '2', 'hc_name' => '캠프파이어']
            // ,['hc_type' => '3', 'hc_name' => '뷰티시설']
            // ,['hc_type' => '4', 'hc_name' => '피트니스센터']
            // ,['hc_type' => '5', 'hc_name' => '픽업서비스']
            ['hc_code' => '0', 'hc_name' => '수영장']
            ,['hc_code' => '1', 'hc_name' => '바베큐장']
            ,['hc_code' => '2', 'hc_name' => '캠프파이어']
            ,['hc_code' => '3', 'hc_name' => '뷰티시설']
            ,['hc_code' => '4', 'hc_name' => '피트니스센터']
            ,['hc_code' => '5', 'hc_name' => '픽업서비스']
        ]);
    }
}
