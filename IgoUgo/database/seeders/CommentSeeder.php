<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
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
            Comment::factory($interval)->create();
        }
    }
}
