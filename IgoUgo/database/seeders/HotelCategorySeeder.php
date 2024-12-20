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
            ['hc_type' => '0', 'hc_name' => '수영장']
            ,['hc_type' => '1', 'hc_name' => '바베큐장']
            ,['hc_type' => '1', 'hc_name' => '캠프파이어']
            ,['hc_type' => '1', 'hc_name' => '뷰티시설']
            ,['hc_type' => '1', 'hc_name' => '피트니스센터']
            ,['hc_type' => '1', 'hc_name' => '픽업서비스']
        ]);
    }
}
