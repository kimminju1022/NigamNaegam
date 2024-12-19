<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PublicAPiDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $url = 'http://apis.data.go.kr/B551011/KorService1/searchStay1';
        $serviceKey = env('API_KEY');

        $response = HTTP::get($url, [
            'serviceKey' => $serviceKey,
            'numOfRows' => 5000,
            'pageNo' => 1,
            'MobileOS' => 'ETC',
            'MobileApp' => 'IgoUgo',
            '_type' => 'json',
        ]);

        $data = $response->json();
        // Log::debug($data);

        foreach ($data['response']['body']['items']['item'] as $item) {
            DB::table('hotels')->insert([
                'addr1' => data_get($item, 'addr1') !== '' ? data_get($item, 'addr1') : null,
                'addr2' => data_get($item, 'addr2') !== '' ? data_get($item, 'addr2') : null,
                'areacode' => data_get($item, 'areacode') !== '' ? data_get($item, 'areacode') : null,
                'benikia' => data_get($item, 'benikia') !== '' ? data_get($item, 'benikia') : false,
                'cat1' => data_get($item, 'cat1') !== '' ? data_get($item, 'cat1') : null,
                'cat2' => data_get($item, 'cat2') !== '' ? data_get($item, 'cat2') : null,
                'cat3' => data_get($item, 'cat3') !== '' ? data_get($item, 'cat3') : null,
                'contentid' => data_get($item, 'contentid') !== '' ? data_get($item, 'contentid') : null,
                'contenttypeid' => data_get($item, 'contenttypeid') !== '' ? data_get($item, 'contenttypeid') : null,
                'firstimage' => data_get($item, 'firstimage') !== '' ? data_get($item, 'firstimage') : null,
                'firstimage2' => data_get($item, 'firstimage2') !== '' ? data_get($item, 'firstimage2') : null,
                'cpyrhtDivCd' => data_get($item, 'cpyrhtDivCd') !== '' ? data_get($item, 'cpyrhtDivCd') : null,
                'goodstay' => data_get($item, 'goodstay') !== '' ? data_get($item, 'goodstay') : false,
                'hanok' => data_get($item, 'hanok') !== '' ? data_get($item, 'hanok') : false,
                'mapx' => data_get($item, 'mapx') !== '' ? data_get($item, 'mapx') : null,
                'mapy' => data_get($item, 'mapy') !== '' ? data_get($item, 'mapy') : null,
                'mlevel' => data_get($item, 'mlevel') !== '' ? data_get($item, 'mlevel') : null,
                'tel' => data_get($item, 'tel') !== '' ? data_get($item, 'tel') : null,
                'title' => data_get($item, 'title') !== '' ? data_get($item, 'title') : null,
                'booktour' => data_get($item, 'booktour') !== '' ? data_get($item, 'booktour') : false,
                'sigungucode' => data_get($item, 'sigungucode') !== '' ? data_get($item, 'sigungucode') : null,
                'createdtime' => date('Y-m-d h:i:s', strtotime(data_get($item, 'createdtime'))) !== '' ? data_get($item, 'createdtime') : null,
                'modifiedtime' => date('Y-m-d h:i:s', strtotime(data_get($item, 'modifiedtime'))) !== '' ? data_get($item, 'modifiedtime') : null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        // Log::debug(DB::getQueryLog());
    }
}
