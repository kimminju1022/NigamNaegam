<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['user_email' => 'test@test.com', 'user_password' => Hash::make('qwe123!@#'), 'user_name' => '김유저', 'user_nickname' => '테스트유저', 'user_profile' => '/default/profile_default.png', 'user_phone' => '01111111111'],
            ['user_email' => 'test2@test.com', 'user_password' => Hash::make('qwe123!@#'), 'user_name' => '박유저', 'user_nickname' => '테스트유저2', 'user_profile' => '/default/profile_default.png', 'user_phone' => '01122222222'],
            ['user_email' => 'test3@test.com', 'user_password' => Hash::make('qwe123!@#'), 'user_name' => '이유저', 'user_nickname' => '테스트유저3', 'user_profile' => '/default/profile_default.png', 'user_phone' => '01133333333'],
            ['user_email' => 'test4@test.com', 'user_password' => Hash::make('qwe123!@#'), 'user_name' => '윤유저', 'user_nickname' => '테스트유저4', 'user_profile' => '/default/profile_default.png', 'user_phone' => '01144444444'],
            ['user_email' => 'test5@test.com', 'user_password' => Hash::make('qwe123!@#'), 'user_name' => '최유저', 'user_nickname' => '테스트유저5', 'user_profile' => '/default/profile_default.png', 'user_phone' => '01155555555'],
        ];
        foreach($data as $item) {
            User::create($item);
        }
    }
}
