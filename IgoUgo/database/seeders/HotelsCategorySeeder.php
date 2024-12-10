<?php

namespace Database\Seeders;

use App\Models\HotelsCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HotelsCategory::insert([
            ['hc_type' => '0', 'hc_name' => '조식']
            ,['hc_type' => '1', 'hc_name' => '금연']
            ,['hc_type' => '2', 'hc_name' => '와이파이']
            ,['hc_type' => '3', 'hc_name' => '주차']
        ]);
    }
}
