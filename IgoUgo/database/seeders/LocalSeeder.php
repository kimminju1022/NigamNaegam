<?php

namespace Database\Seeders;

use App\Models\Local;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Local::insert([
            ['local_type' => '0', 'local_name' => '달서구']
            ,['local_type' => '1', 'local_name' => '달성군']
            ,['local_type' => '2', 'local_name' => '수성구']
            ,['local_type' => '3', 'local_name' => '동구']
            ,['local_type' => '4', 'local_name' => '서구']
            ,['local_type' => '5', 'local_name' => '남구']
            ,['local_type' => '6', 'local_name' => '북구']
            ,['local_type' => '7', 'local_name' => '중구']
            ,['local_type' => '8', 'local_name' => '군위군']
        ]);
    }
}
