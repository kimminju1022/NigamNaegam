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
            ['user_email' => 'admin@admin.com', 'user_password' => Hash::make('admin'), 'user_name' => '김유저', 'user_nickname' => '유저', 'user_profile' => '/default/profile_default.png', 'user_phone' => '01011111111'],
            ['user_email' => 'admin2@admin.com', 'user_password' => Hash::make('admin'), 'user_name' => '박유저', 'user_nickname' => '유저2', 'user_profile' => '/default/profile_default.png', 'user_phone' => '01022222222'],
            ['user_email' => 'admin3@admin.com', 'user_password' => Hash::make('admin'), 'user_name' => '이유저', 'user_nickname' => '유저3', 'user_profile' => '/default/profile_default.png', 'user_phone' => '01033333333'],
            ['user_email' => 'admin4@admin.com', 'user_password' => Hash::make('admin'), 'user_name' => '윤유저', 'user_nickname' => '유저4', 'user_profile' => '/default/profile_default.png', 'user_phone' => '01044444444'],
            ['user_email' => 'admin5@admin.com', 'user_password' => Hash::make('admin'), 'user_name' => '최유저', 'user_nickname' => '유저5', 'user_profile' => '/default/profile_default.png', 'user_phone' => '01055555555'],
        ];
        foreach($data as $item) {
            User::create($item);
        }
    }
}
