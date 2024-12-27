<?php

namespace Database\Seeders;

use App\Models\Board;
use App\Models\Like;
use App\Models\User;
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
        // $total = 200;
        // $interval = 50;
        // for($i = 0; $i < $total; $i += $interval){
        //     Like::factory($interval)->create();
        // }
    

        $boards = Board::select('board_id')->where('bc_type', '0')->orWhere('bc_type', '1')->get();

        foreach($boards as $item) {
            $like = new Like();

            $like->like_flg = rand(0,1);
            $like->board_id = $item->board_id;
            $like->user_id = User::select('user_id')->inRandomOrder()->first()->user_id;
        }

        // foreach($boards as $item) {
        //     $review = new Review();

        //     $review->board_id = $item->board_id;
        //     $review->area_code = Area::select('area_code')->inRandomOrder()->first()->area_code;
        //     $review->rc_type = ReviewCategory::select('rc_type')->inRandomOrder()->first()->rc_type;
        //     $review->rate = random_int(1, 5);
    
        //     $review->save();
        // }

        // foreach($categories as $categoryItem) {
        //     $hotelInfo = new HotelInfo();
        //     $hotelInfo->hotel_id = $hotelItem->hotel_id;
        //     $hotelInfo->hc_type = $categoryItem->hc_type;
        //     $hotelInfo->save();
        // }

    }
}
