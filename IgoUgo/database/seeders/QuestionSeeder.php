<?php

namespace Database\Seeders;

use App\Models\Board;
use App\Models\Question;
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
        // $baseInterval = 1000;
        // $total = Board::select('board_id')->where('bc_type', '2')->count();
        // $interval = $baseInterval > $total ? $total : $baseInterval;
        
        $boards = Board::select('board_id', 'created_at')->where('bc_type', '2')->get();

        // 디폴트 status = 0(답변대기)이니까 2/3정도만 1(완료)로 만드려면 150개정도만 배열로 따로 저장해서 그거만 돌려야함

        foreach($boards as $item) {
            $random_status = random_int(0, 1);
            $date = $this->faker->dateTimeBetween($item->created_at, $item->created_at->copy()->addDays(7));

            $question = new Question();
            $question->board_id = $item->board_id;
            $question->que_content = $random_status === 0 ? null : $this->faker->realText(rand(10, 100));
            $question->que_status = (string)$random_status;
            $question->created_at = $item->created_at;
            $question->updated_at = $random_status === 0 ? $item->created_at : $date;

            $question->save();
        }
    }
}
