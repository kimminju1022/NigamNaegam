<?php

namespace Database\Seeders;

use App\Models\Board;
use App\Models\BoardImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Faker\Generator;
use Illuminate\Container\Container;

class BoardImageSeeder extends Seeder
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
        $boards = Board::select('board_id', 'created_at')->get();
        
        foreach($boards as $item){
            $cnt = random_int(0, 5);
            $date = $item->created_at;
            if($cnt){
                for($i = 0; $i < $cnt; $i++){
                    $boardImage = new BoardImage();

                    $boardImage->board_id = $item->board_id;
                    $boardImage->board_img = '/img_main/back'.($i + 1).'.jpg';
                    $boardImage->created_at = $date;
                    $boardImage->updated_at = $date;

                    $boardImage->save();
                }
            }
        }
    }
}
