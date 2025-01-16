<?php

namespace Database\Seeders;

use App\Models\Notice;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NoticeSeeder extends Seeder
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
        $total = 50;
        $interval = 10;
        for($i = 0; $i < $total; $i += $interval){
            Notice::factory($interval)->create();
        }
    }
}
