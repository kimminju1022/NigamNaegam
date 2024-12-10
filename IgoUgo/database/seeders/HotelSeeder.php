<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hotel = [
            [
                'hc_id' => 1,
                'hotel_latitude' => 35.866910,
                'hotel_longitude' => 128.594506,
                'hotel_title' => '토요코인호텔',
                'hotel_content' => '토요코인 대구 동성로에서 일본식 서비스와 현대적인 편안함을 경험하세요. 정원과 공용 라운지가 있는 조용한 환경을 즐기십시오. 무료 Wi-Fi와 24시간 프런트 데스크를 통해 항상 연결 상태를 유지할 수 있습니다. 대구 근처의 명소를 발견해보세요. 대구의 중심부에 위치한 토요코인 대구 동성로는 관광지, 쇼핑 지역 및 활기찬 나이트라이프에 쉽게 접근할 수 있습니다. 24시간 체크인, 매일 하우스키핑 및 아름다운 정원을 즐기십시오. 편안한 객실에는 에어컨, 무료 인터넷 접속 및 개인 금고가 갖추어져 있습니다. 서문시장, 대구 약령시 한방문화축제 및 대구 약령시 한의학 박물관을 탐험해보세요. 기억에 남는 숙박을 원하는 두 명의 여행객에게 완벽한 선택입니다.',
                'hotel_address' => '대구 중구 동성로1길 15',
                'hotel_price' => 71253
            ],
            [
                'hc_id' => 1,
                'hotel_latitude' => 35.867123,
                'hotel_longitude' => 128.595940,
                'hotel_title' => '호텔인섬니아',
                'hotel_content' => '숙소는 동성로 중심가에 위치해 있어 접근성이 매우 좋으며, 주변에 다양한 식당과 놀거리가 풍부합니다. 객실은 깨끗하고 편안하며, 침대와 비품의 품질이 뛰어납니다. 고객들은 청결도와 시설에 대해 높은 만족도를 보였으며, 직원의 친절한 서비스도 긍정적으로 언급되었습니다. 조식이 제공되며, 전반적으로 쾌적한 분위기를 유지하고 있습니다.',
                'hotel_address' => '대구 중구 동성로2길 27-1',
                'hotel_price' => 75000
            ],
            [
                'hc_id' => 1,
                'hotel_latitude' => 35.867246,
                'hotel_longitude' => 128.598104,
                'hotel_title' => 'HOTEL AU',
                'hotel_content' => '호텔 에이유에서의 숙박은 대구에서 탁월한 선택이라 할 수 있습니다. 이곳에서는 WiFi, 주차 대행, 셀프 주차 등의 무료 특전이 제공됩니다. 반월당역에서 도보로 9분, 중앙로역에서는 9분 거리에 있어 대중 교통편을 이용하기 편리합니다.',
                'hotel_address' => '대구 중구 동성로2길 27-1',
                'hotel_price' => 210000
            ]
        ];


        foreach ($hotel as $hotelData) {
            Hotel::create($hotelData); // id는 자동 생성됨
        }
    }
}
