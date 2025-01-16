<?php

namespace Database\Seeders;

use App\Models\Board;
use App\Models\Route;
use App\Models\RouteSpot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Support\Arr;

class RouteSpotSeeder extends Seeder
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
        $routes = Route::select('route_id', 'created_at', 'updated_at')->get();
        $arr = [
            '그린컴퓨터아트학원 대구캠퍼스'
            ,'경상감영공원'
            ,'신라식당'
            ,'더현대 대구'
            ,'대구오페라하우스'
            ,'스타벅스 대구칠성DT점'
            ,'대구iM뱅크파크'
            ,'달성공원'
            ,'서문시장'
            ,'2.28기념중앙공원'
        ];
        $cnt = rand(0,10);
        
        foreach($routes as $route) {
            $arrCopy = $arr;
            for($i = 0; $i < $cnt; $i++) {
                $randKey = array_rand($arrCopy);
                $routeSpot = new RouteSpot();
                $routeSpot->route_id = $route->route_id;
                $routeSpot->spot_name = $arrCopy[$randKey];
                $routeSpot->created_at = $route->created_at;
                $routeSpot->updated_at = $route->updated_at;
                unset($arrCopy[$randKey]);
                $routeSpot->save();
            }
        }
    }
}
