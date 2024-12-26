<?php

namespace Database\Seeders;

use App\Models\Hotel;
use App\Models\HotelCategory;
use App\Models\HotelInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class HotelInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {   
        $hotels = Hotel::select('hotel_id')->get();

        foreach($hotels as $hotelItem){
            $random_limit = random_int(1, HotelCategory::count());
            $categories = HotelCategory::select('hc_type')->inRandomOrder()->limit($random_limit)->get();

            foreach($categories as $categoryItem) {
                $hotelInfo = new HotelInfo();
                $hotelInfo->hotel_id = $hotelItem->hotel_id;
                $hotelInfo->hc_type = $categoryItem->hc_type;
                $hotelInfo->save();
            }
        }
    }
}
