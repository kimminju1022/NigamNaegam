<?php

namespace Database\Seeders;

use App\Models\HotelInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $total = 200;
        $interval = 50;
        for($i = 0; $i < $total; $i += $interval){
            HotelInfo::factory($interval)->create();
        }
    }
}
