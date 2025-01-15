<?php

namespace Database\Factories;

use App\Models\Board;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BoardImage>
 */
class BoardImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $arrImg = [
            '/img/akdongping.png'
            ,'/img/araping.png'
            ,'/img/arongping.png'
            ,'/img/balletping.png'
            ,'/img/bbanzzakping.png'
            ,'/img/bbosongping.png'
            ,'/img/binggeulping.png'
            ,'/img/chachaping.png'
            ,'/img/chanaping.png'
            ,'/img/chocoping.png'
            ,'/img/chrongping.png'
            ,'/img/dalcomeping.png'
            ,'/img/darongping.png'
            ,'/img/ddiyongping.png'
            ,'/img/dreamping.png'
            ,'/img/fluffyping.png'
            ,'/img/hachu.png'
            ,'/img/saecomping.png'
            ,'/img/sandping.png'
            ,'/img/soljjiping.png'
            ,'/img/trustping.png'
        ];

        $boards = Board::select('board_id', 'created_at')->inRandomOrder()->first();

        return [
            'board_id' => $boards->board_id
            ,'board_img' => Arr::random($arrImg)
            ,'created_at' => $boards->created_at
            ,'updated_at' => $boards->created_at
        ];
    }
}
