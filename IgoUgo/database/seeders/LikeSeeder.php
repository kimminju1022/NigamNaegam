<?php

namespace Database\Seeders;

use App\Models\Like;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
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
            Like::factory($interval)->create();
        }
    }
    

        $boards = Board::select('board_id')->where('bc_type', '0')->orWhere('bc_type', '1')->get();
}
