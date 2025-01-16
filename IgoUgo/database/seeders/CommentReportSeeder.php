<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\CommentReport;
use App\Models\User;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentReportSeeder extends Seeder
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
        $comment = Comment::select('comment_id', 'user_id', 'created_at')->whereNull('deleted_at')->inRandomOrder()->get();

        foreach($comment as $commentItem){
            $random_limit = random_int(0, 15);
            $users = User::select('user_id', 'created_at')->where('user_id', '!=', $commentItem->user_id)->where('manager_flg', '0')->inRandomOrder()->limit($random_limit)->get();
            if($random_limit){
                foreach($users as $user){
                    $startDate = max($commentItem->created_at, $user->created_at);
                    $date = $this->faker->dateTimeBetween($startDate, now());

                    $commentReport = new CommentReport();
                    $commentReport->user_id = $user->user_id;
                    $commentReport->comment_id = $commentItem->comment_id;
                    $commentReport->created_at = $date;
                    $commentReport->updated_at = $date;
                    $commentReport->save();
                }
            }
        }
    }
}
