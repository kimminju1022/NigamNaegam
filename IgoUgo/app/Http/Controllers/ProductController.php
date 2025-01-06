<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function getFilteredProducts() {
        $products = [
            'spot' => Product::where('contenttypeid', '12')->whereNotNull('firstimage')->inRandomOrder()->limit(5)->get(),
            'culture' => Product::where('contenttypeid', '14')->whereNotNull('firstimage')->inRandomOrder()->limit(5)->get(),
            'sports' => Product::where('contenttypeid', '28')->whereNotNull('firstimage')->inRandomOrder()->limit(5)->get(),
            'shopping' => Product::where('contenttypeid', '38')->whereNotNull('firstimage')->inRandomOrder()->limit(5)->get(),
            'restaurant' => Product::where('contenttypeid', '39')->whereNotNull('firstimage')->inRandomOrder()->limit(5)->get()
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
        Log::debug($sort);
        $productList = Product::where('contenttypeid', $contentTypeId)
                                ->when($areaCode, function($query, $areaCode) {
                                    return $query->whereIn('products.area_code', $areaCode);
                                })
                                ->whereNotNull('firstimage')
                                ->select('contentid', 'title', 'firstimage')
                                ->orderBy($sort, 'desc')
                                ->paginate(32);
        $responseData = [
            'success' => true,
            'msg' => '데이터 획득 성공',
            'products' => $productList
        ];
        return response()->json($responseData);
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
            'spot' => Product::where('contenttypeid', '12')->whereNotNull('firstimage')->inRandomOrder()->first(),
            'culture' => Product::where('contenttypeid', '14')->whereNotNull('firstimage')->inRandomOrder()->first(),
            'sports' => Product::where('contenttypeid', '28')->whereNotNull('firstimage')->inRandomOrder()->first(),
            'shopping' => Product::where('contenttypeid', '38')->whereNotNull('firstimage')->inRandomOrder()->first(),
            'restaurant' => Product::where('contenttypeid', '39')->whereNotNull('firstimage')->inRandomOrder()->first()
        ];

        $responseData = [
            'success' => true,
            'msg' => '데이터 획득 성공',
            'products' => $products
        ];

        return response()->json($responseData);
    }
    // public function productDetail($contenttypeid, $id) {
    //     $url = 'http://apis.data.go.kr/B551011/KorService1/detailCommon1';
    //     $serviceKey = env('API_KEY');

    //     // HTTP 요청
    //     $productDetail = Http::get($url, [
    //         'serviceKey' => $serviceKey,
    //         'MobileOS' => 'ETC',
    //         'MobileApp' => 'IgoUgo',
    //         '_type' => 'json',
    //         'contentTypeId' => $contenttypeid,
    //         'contentId' => $id,
    //         'defaultYN' => 'Y',
    //         'firstImageYN' => 'Y',
    //         'addrinfoYN' => 'Y',
    //         'mapinfoYN' => 'Y',
    //         'overviewYN' => 'Y',
    //     ]);
    //     $resultCode = $productDetail->header('resultCode');

    //     if($productDetail->failed() && $resultCode !== '0000') {
    //         throw new \Exception('API 받아오기 실패'. $productDetail->status());
    //     }
        
    //     return response()->json($productDetail->json());
    // }
}
