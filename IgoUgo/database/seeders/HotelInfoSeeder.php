<?php

namespace Database\Seeders;

use App\Models\Hotel;
use App\Models\HotelCategory;
use App\Models\HotelInfo;
use App\Models\Product;
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
        $hotels = Product::select('product_id')->where('contenttypeid', 32)->get();

        foreach($hotels as $hotelItem){
            $random_limit = random_int(1, HotelCategory::count());
            // $categories = HotelCategory::select('hc_type')->inRandomOrder()->limit($random_limit)->get();
            $categories = HotelCategory::select('hc_code')->inRandomOrder()->limit($random_limit)->get();

            foreach($categories as $categoryItem) {
                $hotelInfo = new HotelInfo();
                $hotelInfo->product_id = $hotelItem->product_id;
                // $hotelInfo->hc_type = $categoryItem->hc_type;
                $hotelInfo->hc_code = $categoryItem->hc_code;
                $hotelInfo->save();
            }
        }
    }
}
