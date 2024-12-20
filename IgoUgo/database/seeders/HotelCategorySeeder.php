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
        $hotel = Hotel::select('hotel_id')->inRandomOrder()->first();

        HotelCategory::insert([
            [
                'hotel_id' => $hotel->hotel_id

            ]
        ]);
    }
}
