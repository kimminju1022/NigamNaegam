<?php

namespace Database\Seeders;

use App\Models\ReviewCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        ReviewCategory::insert([
            ['rc_name' => '0', 'rc_type' => '숙박']
            ,['rc_name' => '1', 'rc_type' => '맛집']
            ,['rc_name' => '2', 'rc_type' => '관광']
            ,['rc_name' => '3', 'rc_type' => '문화']
            ,['rc_name' => '4', 'rc_type' => '레포츠']
            ,['rc_name' => '5', 'rc_type' => '쇼핑']
        ]);
    }
}
