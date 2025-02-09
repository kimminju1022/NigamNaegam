<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function getFilteredProducts() {
        $products = [
            'spot' => Product::where('contenttypeid', '12')->whereNotNull('firstimage')->whereNotNull('area_code')->inRandomOrder()->limit(5)->get(),
            'culture' => Product::where('contenttypeid', '14')->whereNotNull('firstimage')->whereNotNull('area_code')->inRandomOrder()->limit(5)->get(),
            'sports' => Product::where('contenttypeid', '28')->whereNotNull('firstimage')->whereNotNull('area_code')->inRandomOrder()->limit(5)->get(),
            'shopping' => Product::where('contenttypeid', '38')->whereNotNull('firstimage')->whereNotNull('area_code')->inRandomOrder()->limit(5)->get(),
            'restaurant' => Product::where('contenttypeid', '39')->whereNotNull('firstimage')->whereNotNull('area_code')->inRandomOrder()->limit(5)->get()
        ];

        $responseData = [
            'success' => true,
            'msg' => '데이터 획득 성공',
            'products' => $products
        ];

        return response()->json($responseData);
    }

    public function showList(Request $request) {
        $contentTypeId = $request->contenttypeid;
        $areaCode = $request->area_code;
        $sort = $request->sort;
        $mapy = $request->latitude; // 위도 y축
        $mapx = $request->longitude; // 경도 x축
        $isActiveRank = $request->isActiveProductRanking;
        // Log::debug($sort);

        $ranking = Product::select('products.product_id', 'products.contentid', 'products.title', 'products.firstimage')
                        ->where('contenttypeid', $contentTypeId)
                        ->when($areaCode, function($query, $areaCode) { // 지역필터
                            return $query->whereIn('products.area_code', $areaCode);  // 동적으로 주어진 $areaCode 배열에 포함된 hotels.area_code 값을 가진 데이터만 필터링한다
                            // wherein 첫번째 인수 = 테이블.칼럼명, 두번째인수 = 비교할 배열
                        })
                        ->when($mapy && $mapx, function ($query) use ($mapy, $mapx) { // 가까운순
                            return $query->selectRaw(
                                "( 6371 * acos( cos( radians(?) ) * cos( radians(mapy) ) * cos( radians(mapx) - radians(?) ) + sin( radians(?) ) * sin( radians(mapy) ) ) ) AS distance",
                                [$mapy, $mapx, $mapy]
                            )->orderBy('distance', 'asc');
                        })
                        ->when($isActiveRank, function($query) {
                            return $query->addSelect(DB::raw('IFNULL(AVG(reviews.rate), 0) as avg_rate'))
                            ->leftJoin('reviews', 'products.product_id', '=', 'reviews.product_id')
                            ->groupBy('products.product_id', 'products.title', 'products.firstimage', 'products.contentid')
                            ->orderByDesc('avg_rate');
                        })
                        ->when($sort === 'createdtime', function ($query, $sort) {
                            return $query->orderBy($sort, 'desc');
                        })
                        ->paginate(32);

                        return response()->json($ranking->toArray());
    }

    public function areas(Request $request) {
        $areas = Area::get();
        return response()->json($areas);
    }

    public function productDetail($contenttypeid, $contentid) {
        $url1 = 'http://apis.data.go.kr/B551011/KorService1/detailImage1';
        $url2 = 'http://apis.data.go.kr/B551011/KorService1/detailCommon1';
        $serviceKey = env('API_KEY');

        // HTTP 요청
        $response1 = Http::get($url1, [
            'serviceKey' => $serviceKey,
            'MobileOS' => 'ETC',
            'MobileApp' => 'IgoUgo',
            '_type' => 'json',
            'contentId' => $contentid,
            'imageYN' => 'Y',
            'subImageYN' => 'Y',
        ]);
        $resultCode1 = $response1->header('resultCode');

        if($response1->failed() && $resultCode1 !== '0000') {
            throw new \Exception('API 받아오기 실패'. $response1->status());
        }

        $response2 = Http::get($url2, [
            'serviceKey' => $serviceKey,
            'MobileOS' => 'ETC',
            'MobileApp' => 'IgoUgo',
            '_type' => 'json',
            'contentTypeId' => $contenttypeid,
            'contentId' => $contentid,
            'defaultYN' => 'Y',
            'firstImageYN' => 'Y',
            'addrinfoYN' => 'Y',
            'mapinfoYN' => 'Y',
            'overviewYN' => 'Y',
        ]);
        $resultCode = $response2->header('resultCode');

        if($response2->failed() && $resultCode !== '0000') {
            throw new \Exception('API 받아오기 실패'. $response2->status());
        }

        $productImg = $response1->json();
        $productDetail = $response2->json();
        
        return response()->json([
            'productImg' => $productImg,
            'productDetail' => $productDetail,
        ]);
    }

    public function getProductRandom() {
        $products = [
            'spot' => Product::where('contenttypeid', '12')->whereNotNull('firstimage')->whereNotNull('area_code')->inRandomOrder()->first(),
            'culture' => Product::where('contenttypeid', '14')->whereNotNull('firstimage')->whereNotNull('area_code')->inRandomOrder()->first(),
            'sports' => Product::where('contenttypeid', '28')->whereNotNull('firstimage')->whereNotNull('area_code')->inRandomOrder()->first(),
            'shopping' => Product::where('contenttypeid', '38')->whereNotNull('firstimage')->whereNotNull('area_code')->inRandomOrder()->first(),
            'restaurant' => Product::where('contenttypeid', '39')->whereNotNull('firstimage')->whereNotNull('area_code')->inRandomOrder()->first()
        ];

        $responseData = [
            'success' => true,
            'msg' => '데이터 획득 성공',
            'products' => $products
        ];

        return response()->json($responseData);
    }

    // public function getNearbyPlaces($lat, $lon) {
    public function getNearbyPlaces(Request $request) {
        // 유효성 검사
        $validated = $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);
        
        $currentLat = $validated['latitude'];
        $currentLon = $validated['longitude'];

        $areaCode = $request->area_code;
        $contentTypeId = $request->content_type_id;

        $places = 
            Product::where("contenttypeid", $contentTypeId) // 해당 contenttypeid에 맞는 데이터 조회회
            ->when($areaCode, function($query, $areaCode) { 
                return $query->whereIn('products.area_code', $areaCode);  // 동적으로 주어진 $areaCode 배열에 포함된 hotels.area_code 값을 가진 데이터만 필터링한다
                // wherein 첫번째 인수 = 테이블.칼럼명, 두번째인수 = 비교할 배열
            })
            ->whereNotNull('products.firstimage') // 사진있는것만 가져오기
            ->whereNotNull('products.area_code') // area_code 있는것만 가져오기
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
