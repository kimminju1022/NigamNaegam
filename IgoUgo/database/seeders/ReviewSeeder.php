<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Board;
use App\Models\Review;
use App\Models\ReviewCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Support\Arr;

class ReviewSeeder extends Seeder
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
        $boards = Board::select('board_id')->where('bc_type', '0')->get();
        // $area_arr = $areas->toArray();
        // $area_rand = Arr::random($area_arr);
        
        foreach($boards as $item) {
            $review = new Review();

            $review->board_id = $item->board_id;
            $review->area_code = Area::select('area_code')->inRandomOrder()->first()->area_code;
            $review->rc_type = ReviewCategory::select('rc_type')->inRandomOrder()->first()->rc_type;
            $review->rate = random_int(1, 5);
    
            $review->save();
        }
    }
}
