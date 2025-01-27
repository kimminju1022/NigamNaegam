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
            ,UserControlSeeder::class
            ,AreaSeeder::class
            // ,FestivalSeeder::class
            // ,HotelSeeder::class
            ,ProductSeeder::class
            ,HotelCategorySeeder::class
            ,HotelInfoSeeder::class
            ,BoardCategorySeeder::class
            ,BoardSeeder::class
            ,BoardImageSeeder::class
            ,BoardReportSeeder::class
            ,CommentSeeder::class
            ,CommentReportSeeder::class
            ,LikeSeeder::class
            ,QuestionCategorySeeder::class
            ,QuestionSeeder::class
            ,ReviewCategorySeeder::class
            ,ReviewSeeder::class
        ]);
    }
}
