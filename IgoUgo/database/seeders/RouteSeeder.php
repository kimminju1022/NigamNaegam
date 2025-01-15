<?php

namespace Database\Seeders;

use App\Models\Board;
use App\Models\Route;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator;
use Illuminate\Container\Container;

class RouteSeeder extends Seeder
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
        $boards = Board::select('board_id')->where('bc_code', '3')->get();

        foreach($boards as $item) {
            $route = new Route();

            $route->board_id = $item->board_id;
            $route->route_theme = rand(0,3);
            $route->route_people = rand(0,3);

            $route->timestamps = false;
            $route->save();
        }
    }
}
