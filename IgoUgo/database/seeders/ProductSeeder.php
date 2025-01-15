<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $url = 'http://apis.data.go.kr/B551011/KorService1/areaBasedList1';
        $serviceKey = env('API_KEY');

        // 호텔, 즐길거리, 축제 한번에 호출
        for ($i = 1 ; $i <= 100 ; $i++ ) {

            $responsePlay = Http::get($url, [
                'serviceKey' => $serviceKey,
                'numOfRows' => 5000,
                'pageNo' => $i,
                'MobileOS' => 'ETC',
                'MobileApp' => 'IgoUgo',
                '_type' => 'json',
            ]);

            $dataPlay = $responsePlay->json();

            if (empty($dataPlay['response']['body']['items']['item'])) {
                break;
            }

            foreach ($dataPlay['response']['body']['items']['item'] as $item) {
                DB::table('products')->insert([
                    'title' => data_get($item, 'title') !== '' ? data_get($item, 'title') : null,
                    'addr1' => data_get($item, 'addr1') !== '' ? data_get($item, 'addr1') : null,
                    'addr2' => data_get($item, 'addr2') !== '' ? data_get($item, 'addr2') : null,
                    'tel' => data_get($item, 'tel') !== '' ? data_get($item, 'tel') : null,
                    'area_code' => data_get($item, 'areacode') !== '' ? data_get($item, 'areacode') : null,
                    'cat1' => data_get($item, 'cat1') !== '' ? data_get($item, 'cat1') : null,
                    'cat2' => data_get($item, 'cat2') !== '' ? data_get($item, 'cat2') : null,
                    'cat3' => data_get($item, 'cat3') !== '' ? data_get($item, 'cat3') : null,
                    'contentid' => data_get($item, 'contentid') !== '' ? data_get($item, 'contentid') : null,
                    'contenttypeid' => data_get($item, 'contenttypeid') !== '' ? data_get($item, 'contenttypeid') : null,
                    'firstimage' => data_get($item, 'firstimage') !== '' ? data_get($item, 'firstimage') : null,
                    'firstimage2' => data_get($item, 'firstimage2') !== '' ? data_get($item, 'firstimage2') : null,
                    'cpyrhtDivCd' => data_get($item, 'cpyrhtDivCd') !== '' ? data_get($item, 'cpyrhtDivCd') : null,
                    'mapx' => data_get($item, 'mapx') !== '' ? data_get($item, 'mapx') : null,
                    'mapy' => data_get($item, 'mapy') !== '' ? data_get($item, 'mapy') : null,
                    'mlevel' => data_get($item, 'mlevel') !== '' ? data_get($item, 'mlevel') : null,
                    'sigungucode' => data_get($item, 'sigungucode') !== '' ? data_get($item, 'sigungucode') : null,
                    'createdtime' => date('Y-m-d h:i:s', strtotime(data_get($item, 'createdtime'))) !== '' ? data_get($item, 'createdtime') : null,
                    'modifiedtime' => date('Y-m-d h:i:s', strtotime(data_get($item, 'modifiedtime'))) !== '' ? data_get($item, 'modifiedtime') : null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // ------------------------------
        // 이전 코드

        // $url = 'http://apis.data.go.kr/B551011/KorService1/areaBasedList1';
        // $serviceKey = env('API_KEY');

        // for ($i = 1 ; $i <= 100 ; $i++ ) {

        //     $response = Http::get($url, [
        //         'serviceKey' => $serviceKey,
        //         'numOfRows' => 5000,
        //         'pageNo' => $i,
        //         'MobileOS' => 'ETC',
        //         'MobileApp' => 'IgoUgo',
        //         '_type' => 'json',
        //     ]);

        //     $data = $response->json();
        //     // Log::debug($data);
        //     if (empty($data['response']['body']['items']['item'])) {
        //         break;
        //     }

        //     foreach ($data['response']['body']['items']['item'] as $item) {
        //         DB::table('products')->insert([
        //             'title' => data_get($item, 'title') !== '' ? data_get($item, 'title') : null,
        //             'addr1' => data_get($item, 'addr1') !== '' ? data_get($item, 'addr1') : null,
        //             'addr2' => data_get($item, 'addr2') !== '' ? data_get($item, 'addr2') : null,
        //             'tel' => data_get($item, 'tel') !== '' ? data_get($item, 'tel') : null,
        //             'area_code' => data_get($item, 'areacode') !== '' ? data_get($item, 'areacode') : null,
        //             'booktour' => data_get($item, 'booktour') !== '' ? data_get($item, 'booktour') : false,
        //             'cat1' => data_get($item, 'cat1') !== '' ? data_get($item, 'cat1') : null,
        //             'cat2' => data_get($item, 'cat2') !== '' ? data_get($item, 'cat2') : null,
        //             'cat3' => data_get($item, 'cat3') !== '' ? data_get($item, 'cat3') : null,
        //             'contentid' => data_get($item, 'contentid') !== '' ? data_get($item, 'contentid') : null,
        //             'contenttypeid' => data_get($item, 'contenttypeid') !== '' ? data_get($item, 'contenttypeid') : null,
        //             'firstimage' => data_get($item, 'firstimage') !== '' ? data_get($item, 'firstimage') : null,
        //             'firstimage2' => data_get($item, 'firstimage2') !== '' ? data_get($item, 'firstimage2') : null,
        //             'cpyrhtDivCd' => data_get($item, 'cpyrhtDivCd') !== '' ? data_get($item, 'cpyrhtDivCd') : null,
        //             'mapx' => data_get($item, 'mapx') !== '' ? data_get($item, 'mapx') : null,
        //             'mapy' => data_get($item, 'mapy') !== '' ? data_get($item, 'mapy') : null,
        //             'mlevel' => data_get($item, 'mlevel') !== '' ? data_get($item, 'mlevel') : null,
        //             'sigungucode' => data_get($item, 'sigungucode') !== '' ? data_get($item, 'sigungucode') : null,
        //             'zipcode' => data_get($item, 'zipcood') !== '' ? data_get($item, 'zipcode') : null,
        //             'createdtime' => date('Y-m-d h:i:s', strtotime(data_get($item, 'createdtime'))) !== '' ? data_get($item, 'createdtime') : null,
        //             'modifiedtime' => date('Y-m-d h:i:s', strtotime(data_get($item, 'modifiedtime'))) !== '' ? data_get($item, 'modifiedtime') : null,
        //             'created_at' => now(),
        //             'updated_at' => now(),
        //         ]);
        //     }
        // }
    }
}
