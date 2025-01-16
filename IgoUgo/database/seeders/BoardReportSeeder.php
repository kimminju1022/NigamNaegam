<?php

namespace Database\Seeders;

use App\Models\Board;
use App\Models\BoardReport;
use App\Models\User;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class BoardReportSeeder extends Seeder
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
        $board = Board::select('board_id', 'user_id', 'created_at')->inRandomOrder()->get();

        foreach($board as $boardItem){
            $random_limit = random_int(0, 4);
            $users = User::select('user_id')->where('user_id', '!=', $boardItem->user_id)->where('manager_flg', '0')->inRandomOrder()->limit($random_limit)->get();
            if($random_limit){
                foreach($users as $user){
                    $date = $this->faker->dateTimeBetween($boardItem->created_at, now());

                    $boardReport = new BoardReport();
                    $boardReport->board_id = $boardItem->board_id;
                    $boardReport->user_id = $user->user_id;
                    $boardReport->created_at = $date;
                    $boardReport->updated_at = $date;
                    $boardReport->save();
                }
            }
        }
    }
}
