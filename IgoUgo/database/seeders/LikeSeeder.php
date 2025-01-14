<?php

namespace Database\Seeders;

use App\Models\Board;
use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator;
use Illuminate\Container\Container;

class LikeSeeder extends Seeder
{
    /**
     * The current Faker instance.
     *
     * @var \Faker\Generator
     */
    protected $faker;

    /**
     * Create a new seeder instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->faker = Container::getInstance()->make(Generator::class);
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $boards = Board::select('board_id', 'created_at')
                        // ->where('bc_type', '0')
                        // ->orWhere('bc_type', '1')
                        ->where('bc_code', '0')
                        ->orWhere('bc_code', '1')
                        ->get();
        foreach($boards as $item) {
            $like = new Like();
            $date = $this->faker->dateTimeBetween($item->created_at, $item->created_at->copy()->addDays(7));

            $like->like_flg = rand(0,1);
            $like->board_id = $item->board_id;
            $like->user_id = User::select('user_id')->inRandomOrder()->first()->user_id;
            $like->created_at = $date;
            $like->updated_at = $date;
    
            $like->save(); 
        }
    }
}
