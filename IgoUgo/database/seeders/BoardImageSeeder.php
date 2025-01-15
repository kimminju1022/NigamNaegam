<?php

namespace Database\Seeders;

use App\Models\Board;
use App\Models\BoardImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class BoardImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // BoardImage::factory(100)->create();
        // 이미지 여러개 랜덤으로 넣는 방법 생각중

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

        $boards = Board::select('board_id', 'created_at')->get();

        foreach($boards as $item) {
            $cnt = rand(1,5);
            $board_image = new BoardImage();

            $board_image->board_id = $item->board_id;
            for($i = 0; $i < $cnt; $i++){
                $board_image->board_img = Arr::random($arrImg);
            }
            $board_image->created_at = $item->created_at;
            $board_image->updated_at = $item->created_at;
        }
    }
}
