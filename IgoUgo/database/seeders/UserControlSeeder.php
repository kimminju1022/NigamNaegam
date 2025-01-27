<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserControl;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Log;

class UserControlSeeder extends Seeder
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
        $users = User::select('user_id', 'user_out')->where('manager_flg', '0')->get(); // 일반 유저만 들고오기
        foreach($users as $item) {
            $user_control = new UserControl();
            // 강퇴당한 유저
            if($item->user_out === '1') {
                $expires_at = '9999-12-31 23:59:59';
            
            // else if($item->user_out === 0) {
            //     // 강퇴는 아니지만 탈퇴한 유저인 경우 과거의 제재이력
            //     if($item->user_flg === 1) {
            //         // 탈퇴한 날짜인 updated_at보다 작아야함
            //         // $expires_at <= $item->updated_at;
            //         $expires_at = $this->faker->dateTimeBetween($item->created_at, $item->updated_at->copy()->addDays(-1));
            //     } 
            // } 

                $user_control->user_id = $item->user_id;
                $user_control->expires_at = $expires_at;
                $user_control->save();
                Log::debug($user_control);
            }
        }
    }
}
