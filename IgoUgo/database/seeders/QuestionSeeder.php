<?php

namespace Database\Seeders;

use App\Models\Board;
use App\Models\Question;
use App\Models\User;
use Carbon\Carbon;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class QuestionSeeder extends Seeder
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
        // $boards = Board::select('board_id', 'created_at')->where('bc_type', '2')->get();
        $boards = Board::select('board_id', 'board_flg', 'created_at', 'deleted_at')->where('bc_code', '2')->get();

        foreach($boards as $item) {
            $random_status = random_int(0, 1);
            $date = $this->faker->dateTimeBetween($item->created_at, $item->created_at->copy()->addDays(7));
            $flg_date = Carbon::now()->subMonths(6);

            if(Carbon::parse($date)->lt($flg_date)) {
                $update = Carbon::parse($date)->addMonths(6);
            } else {
                $update = $date;
            }

            $question = new Question();

            $question->board_id = $item->board_id;
            $question->user_id = User::select('user_id')->where('manager_flg', 1)->inRandomOrder()->first()->user_id;
            $question->que_content = $random_status === 0 ? null : $this->faker->realText(rand(10, 2000));
            $question->que_status = (string)$random_status;

            if($item->board_flg === '0') {
                $question->que_flg = '0';
                $question->created_at = $item->created_at;
                $question->updated_at = $random_status === 0 ? $item->created_at : $date;
            } else if($item->board_flg === '1') {
                $question->que_flg = '1';
                $question->created_at = $item->created_at;
                $question->updated_at = $update;
                $question->deleted_at = $update === $date ? null : $update;

            }
            $question->save();
        }
            // $question->que_flg = $item->board_flg === '0' ? '0' : '1';
    }
}
