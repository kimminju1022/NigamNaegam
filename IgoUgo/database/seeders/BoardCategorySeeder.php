<?php

namespace Database\Seeders;

use App\Models\BoardCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BoardCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BoardCategory::insert([
            // ['bc_type' => '0', 'bc_name' => '리뷰게시판']
            // ,['bc_type' => '1', 'bc_name' => '자유게시판']
            // ,['bc_type' => '2', 'bc_name' => '문의게시판']
            ['bc_code' => '0', 'bc_name' => '리뷰게시판']
            ,['bc_code' => '1', 'bc_name' => '자유게시판']
            ,['bc_code' => '2', 'bc_name' => '문의게시판']
            ,['bc_code' => '3', 'bc_name' => '루트게시판']
        ]);
    }
}
