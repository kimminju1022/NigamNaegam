<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Generator;
use Illuminate\Container\Container;

class UserSeeder extends Seeder
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

        $date = '2024-01-01 00:00:00';
        $last_login = Carbon::now();
        
        $data = [
            ['manager_flg'=> '1', 'user_flg' => '0', 'user_email' => 'test@test.com', 'user_password' => Hash::make('qwer1234!'), 'user_name' => '이경진', 'user_nickname' => '이경진', 'user_last_login' => $last_login,'user_phone' => '01011111111', 'user_profile' => '/default/profile_default.png', 'email_verified_at' => $date, 'created_at' => $date, 'updated_at' => $date],
            ['manager_flg'=> '1', 'user_flg' => '0', 'user_email' => 'test2@test.com', 'user_password' => Hash::make('qwer1234!'), 'user_name' => '김지민', 'user_nickname' => '김지민', 'user_last_login' => $last_login, 'user_phone' => '01022222222', 'user_profile' => '/default/profile_default.png', 'email_verified_at' => $date, 'created_at' => $date, 'updated_at' => $date],
            ['manager_flg'=> '1', 'user_flg' => '0', 'user_email' => 'test3@test.com', 'user_password' => Hash::make('qwer1234!'), 'user_name' => '윤종승', 'user_nickname' => '윤종승', 'user_last_login' => $last_login, 'user_phone' => '01033333333', 'user_profile' => '/default/profile_default.png', 'email_verified_at' => $date, 'created_at' => $date, 'updated_at' => $date],
            ['manager_flg'=> '1', 'user_flg' => '0', 'user_email' => 'test4@test.com', 'user_password' => Hash::make('qwer1234!'), 'user_name' => '김민주', 'user_nickname' => '김민주', 'user_last_login' => $last_login, 'user_phone' => '01044444444', 'user_profile' => '/default/profile_default.png', 'email_verified_at' => $date, 'created_at' => $date, 'updated_at' => $date],
        ];

        // $date = $this->faker->dateTimeBetween('-1 year');
        
        // $data = [
        //     ['manager_flg'=> '1', 'user_flg' => '0', 'user_email' => 'test@test.com', 'user_password' => Hash::make('qwer1234!'), 'user_name' => '이경진', 'user_nickname' => '이경진',  'user_phone' => '01011111111', 'user_profile' => '/default/profile_default.png', 'email_verified_at' => $date, 'created_at' => $date, 'updated_at' => $date],
        //     ['manager_flg'=> '1', 'user_flg' => '0', 'user_email' => 'test2@test.com', 'user_password' => Hash::make('qwer1234!'), 'user_name' => '김지민', 'user_nickname' => '김지민', 'user_phone' => '01022222222', 'user_profile' => '/default/profile_default.png', 'email_verified_at' => $date, 'created_at' => $date, 'updated_at' => $date],
        //     ['manager_flg'=> '1', 'user_flg' => '0', 'user_email' => 'test3@test.com', 'user_password' => Hash::make('qwer1234!'), 'user_name' => '윤종승', 'user_nickname' => '윤종승', 'user_phone' => '01033333333', 'user_profile' => '/default/profile_default.png', 'email_verified_at' => $date, 'created_at' => $date, 'updated_at' => $date],
        //     ['manager_flg'=> '1', 'user_flg' => '0', 'user_email' => 'test4@test.com', 'user_password' => Hash::make('qwer1234!'), 'user_name' => '김민주', 'user_nickname' => '김민주', 'user_phone' => '01044444444', 'user_profile' => '/default/profile_default.png', 'email_verified_at' => $date, 'created_at' => $date, 'updated_at' => $date],
        // ];

        foreach($data as $item) {
            User::create($item);
        }

        $total = 200;
        $interval = 50;
        for($i = 0; $i < $total; $i += $interval){
            User::factory($interval)->create();
        }
    }
}
