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
            ,['hc_type' => '1', 'hc_name' => '질문게시판']
            ,['hc_type' => '2', 'hc_name' => '문의게시판']
            ,['hc_type' => '3', 'hc_name' => '문의게시판']
        ]);
    }
}
