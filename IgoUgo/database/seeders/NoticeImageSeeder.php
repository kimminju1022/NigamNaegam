<?php

namespace Database\Seeders;

use App\Models\Notice;
use App\Models\NoticeImage;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NoticeImageSeeder extends Seeder
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
        $notices = Notice::select('notice_id')->get();
        
        foreach($notices as $noticeItem){
            $random_cnt = random_int(0, 5);
            $date = $this->faker->dateTimeBetween('-1 year');
            if($random_cnt){
                for($i = 0; $i < $random_cnt; $i++){
                    $noticeImage = new NoticeImage();
                    $noticeImage->notice_id = $noticeItem->notice_id;
                    $noticeImage->notice_img = '/img_main/back'.($i + 1).'.jpg';
                    $noticeImage->created_at = $date;
                    $noticeImage->updated_at = $date;
                    $noticeImage->save();
                }
            }
        }
    }
}
