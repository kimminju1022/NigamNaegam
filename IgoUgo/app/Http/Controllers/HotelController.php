<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Hotel;
use App\Models\HotelCategory;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HotelController extends Controller
{
    public function hotels(Request $request) {
        $areaCode = $request->area_code;
        $hcType = $request->hc_code;
        $sort = $request->sort;

        $hotels = Product::where('contenttypeid', '32') // 호텔 모두 조회하는 걸로 변경
            // ->whereIn('cat3', ['B02010100', 'B02010700', 'B02011100']) // 소분류에 맞는 호텔, 게스트하우스, 팬션 만 조회
            ->when($areaCode, function($query, $areaCode) { 
                return $query->whereIn('products.area_code', $areaCode);  // 동적으로 주어진 $areaCode 배열에 포함된 hotels.area_code 값을 가진 데이터만 필터링한다
                // wherein 첫번째 인수 = 테이블.칼럼명, 두번째인수 = 비교할 배열
            })
            ->when($hcType, function($query, $hcType) {
                return $query->whereHas('hotel_infos', function(Builder $query) use($hcType) { // whereHas는 조건에 맞는 데이터만 가져온다 ex) $hcType이 1이면 1에 해당하는 특정 hc_type을 가져온다 / 외부변수를 사용할수없지만 use 를사용하면 외부 변수를 끌어다가 사용할수 있음
                    // whereHas 첫번째인수 = 여기서는 hotelInfos라는 모델과의 관계를, 지정 두번째인수 = 익명함수 / wherehas를 사용하는이유(일대다 관계기떄문에 단순히 whereIn을 사용할수없다.) whererha 쓰렴ㄴ
                    $query->whereIn('hc_code', $hcType);  // 동적으로 주어진 $hcType 배열에 포함된 hc_type 값을 가진 데이터만 필터링한다
                    // wherein 첫번째 인수 = 테이블.칼럼명, 두번째인수 = 비교할 배열
                });                                        
            })
            ->whereNotNull('products.firstimage') // 사진있는것만 가져오기
            ->select('product_id', 'title', 'firstimage', 'contentid') // 호텔아이디, 호텔이름, 사진만 가져오기
            ->orderBy($sort, 'desc')    // 파일 업로드한날로 최신순으로 정렬
            ->paginate(32); // 페이지네이션

        return response()->json($hotels);
    }
    public function hotelsDetail($getContentId) {
        Log::debug($getContentId);
        $API_KEY = env('API_KEY');
        $url = 'http://apis.data.go.kr/B551011/KorService1/detailCommon1';
        $urlImg = 'http://apis.data.go.kr/B551011/KorService1/detailImage1';

        $getHotelsDetail = Http::get($url, [
            'MobileOS' => 'ETC',
            'MobileApp' => 'IgoUgo',
            'serviceKey' => $API_KEY,
            'contentId' => $getContentId,
            'defaultYN' => 'Y',
            'firstImageYN' => 'Y',
            'overviewYN' => 'Y',
            'addrinfoYN' => 'Y',
            'mapinfoYN' => 'Y',
            '_type' => 'json',            
        ]);

        $resultCode = $getHotelsDetail->header('resultCode');

        if($getHotelsDetail->failed() && $resultCode !== '0000') {
            throw new \Exception('API 받아오기 실패'. $getHotelsDetail->status());
        }

        $getHotelsImg = Http::get($urlImg, [
            'MobileOS' => 'ETC',
            'MobileApp' => 'IgoUgo',
            'serviceKey' => $API_KEY,
            'contentId' => $getContentId,
            'imageYN' => 'Y',
            'subImageYN' => 'Y',
            '_type' => 'json',  
        ]);

        $resultCodeImg = $getHotelsImg->header('resultcode');

        if($getHotelsImg->failed() && $resultCodeImg !== '0000') {
            throw new \Exception('API 받아오기 실패'. $getHotelsDetail->status());
        }

        $hotelsDetail = $getHotelsDetail->json();
        $hotelsImg = $getHotelsImg->json();

        return response()->json([
            'hotelsDetail' => $hotelsDetail,
            'hotelsImg' => $hotelsImg,
        ]);
    }

    public function areas(Request $request) {
        $areas = Area::get();

        return response()->json($areas);
    }

    public function categories(Request $request) {
        $categories = HotelCategory::get();

        return response()->json($categories);
    }

    // 반경 1km 내의 모든 데이터
    public function getNearbyPlaces(Request $request) {
        // 유효성 검사
        $validated = $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);
        
        $currentLat = $validated['latitude'];
        $currentLon = $validated['longitude'];

        $areaCode = $request->area_code;
        $hcType = $request->hc_code;

        $places = 
            Product::where("contenttypeid", "32") // 호텔 모두 조회하는 걸로 변경
            // ->whereIn('cat3', ['B02010100', 'B02010700', 'B02011100']) // 소분류에 맞는 호텔, 게스트하우스, 팬션 만 조회
            ->when($areaCode, function($query, $areaCode) { 
                return $query->whereIn('products.area_code', $areaCode);  // 동적으로 주어진 $areaCode 배열에 포함된 hotels.area_code 값을 가진 데이터만 필터링한다
                // wherein 첫번째 인수 = 테이블.칼럼명, 두번째인수 = 비교할 배열
            })
            ->when($hcType, function($query, $hcType) {
                return $query->whereHas('hotel_infos', function(Builder $query) use($hcType) { // whereHas는 조건에 맞는 데이터만 가져온다 ex) $hcType이 1이면 1에 해당하는 특정 hc_type을 가져온다 / 외부변수를 사용할수없지만 use 를사용하면 외부 변수를 끌어다가 사용할수 있음
                    // whereHas 첫번째인수 = 여기서는 hotelInfos라는 모델과의 관계를, 지정 두번째인수 = 익명함수 / wherehas를 사용하는이유(일대다 관계기떄문에 단순히 whereIn을 사용할수없다.) whererha 쓰렴ㄴ
                    $query->whereIn('hc_code', $hcType);  // 동적으로 주어진 $hcType 배열에 포함된 hc_type 값을 가진 데이터만 필터링한다
                    // wherein 첫번째 인수 = 테이블.칼럼명, 두번째인수 = 비교할 배열
                });                                        
            })
            ->whereNotNull('products.firstimage') // 사진있는것만 가져오기
            ->selectRaw("*, (6371 * acos(
                cos(radians(?)) * cos(radians(mapy)) *
                cos(radians(mapx) - radians(?)) +
                sin(radians(?)) * sin(radians(mapy))
            )) AS distance", [$currentLat, $currentLon, $currentLat])
            ->having('distance', '<=', 5) // km 기준
            ->orderBy('distance')
            ->get();

        return response()->json($places);
    }
}
