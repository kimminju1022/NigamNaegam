<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        
        $this->call([
            UserSeeder::class
            ,AreaSeeder::class
            ,FestivalSeeder::class
            ,HotelSeeder::class
            ,HotelCategorySeeder::class
            ,HotelInfoSeeder::class
            ,ProductSeeder::class
            ,BoardCategorySeeder::class
            ,BoardSeeder::class
            ,CommentSeeder::class
            ,LikeSeeder::class
            ,QuestionSeeder::class
            ,ReviewCategorySeeder::class
            ,ReviewSeeder::class
        ]);
    }
}
