<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $url = 'http://apis.data.go.kr/B551011/KorService1/areaCode1';
        $serviceKey = env('API_KEY');

        $response = Http::get($url, [
            'serviceKey' => $serviceKey,
            'numOfRows' => 20,
            'pageNo' => 1,
            'MobileOS' => 'ETC',
            'MobileApp' => 'IgoUgo',
            '_type' => 'json',
        ]);

        $data = $response->json();
        // Log::debug($data);

        foreach ($data['response']['body']['items']['item'] as $item) {
            DB::table('areas')->insert([
                'area_code' => data_get($item, 'code') !== '' ? data_get($item, 'code') : null,
                'area_name' => data_get($item, 'name') !== '' ? data_get($item, 'name') : null,
                'area_rnum' => data_get($item, 'rnum') !== '' ? data_get($item, 'rnum') : null,
            ]);
        }
    }
}
