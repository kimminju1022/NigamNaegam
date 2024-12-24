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
            ['rc_type' => '0', 'rc_name' => '숙박']
            ,['rc_type' => '1', 'rc_name' => '맛집']
            ,['rc_type' => '2', 'rc_name' => '관광']
            ,['rc_type' => '3', 'rc_name' => '문화']
            ,['rc_type' => '4', 'rc_name' => '레포츠']
            ,['rc_type' => '5', 'rc_name' => '쇼핑']
        ]);
    }
}
