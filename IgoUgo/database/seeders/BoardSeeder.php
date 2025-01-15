<?php

namespace Database\Seeders;

use App\Models\Board;
use App\Models\BoardCategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator;
use Illuminate\Container\Container;

class BoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $total = 500;
        $interval = 50;
        for($i = 0; $i < $total; $i += $interval){
            Board::factory($interval)->create();
        }
    }
}
