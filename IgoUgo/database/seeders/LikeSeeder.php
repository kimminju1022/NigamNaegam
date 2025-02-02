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
        $boards = Board::select('board_id', 'user_id', 'created_at')
                        ->whereIn('bc_code', ['0', '1', '3', '4']) // 문의, 공지사항 제외 모든 게시판
                        ->whereNull('deleted_at')
                        ->inRandomOrder()
                        ->get();
        foreach($boards as $boardItem) {
            $random_limit = random_int(0, 50);
            $users = User::select('user_id', 'created_at')->where('user_id', '!=', $boardItem->user_id)->where('manager_flg', '0')->inRandomOrder()->limit($random_limit)->get();
            if($random_limit){
                foreach($users as $user){
                    $startDate = max($boardItem->created_at, $user->created_at);
                    $date = $this->faker->dateTimeBetween($startDate, now());

                    $like = new Like();
        
                    $like->like_flg = rand(0,1);
                    $like->board_id = $boardItem->board_id;
                    $like->user_id = $user->user_id;
                    $like->created_at = $date;
                    $like->updated_at = $date;
                    $like->save(); 
                }
            }
        }
    }
}
