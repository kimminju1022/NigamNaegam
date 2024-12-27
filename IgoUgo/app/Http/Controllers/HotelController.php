<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Hotel;
use App\Models\HotelCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HotelController extends Controller
{
    public function hotels(Request $request) {
        Log::debug('request', $request->all());
        $areaCode = $request->area_code;
        $hcType = $request->hc_type;
        // Log::debug('hcType', $hcType);

        // $hotels = Hotel::with(['hotelInfos.hotelCategory'])
        $hotels = Hotel::whereIn('cat3', ['B02010100', 'B02010700', 'B02011100']) // 소분류에 맞는 호텔, 게스트하우스, 팬션 만 조회
            ->when($areaCode, function($query, $areaCode) { 
                return $query->whereIn('hotels.area_code', $areaCode);  // 동적으로 주어진 $areaCode 배열에 포함된 hotels.area_code 값을 가진 데이터만 필터링한다
                // wherein 첫번째 인수 = 테이블.칼럼명, 두번째인수 = 비교할 배열
            })
            ->when($hcType, function($query, $hcType) {
                return $query->whereHas('hotelInfos', function(Builder $query) use($hcType) { // whereHas는 조건에 맞는 데이터만 가져온다 ex) $hcType이 1이면 1에 해당하는 특정 hc_type을 가져온다 / 외부변수를 사용할수없지만 use 를사용하면 외부 변수를 끌어다가 사용할수 있음
                    // whereHas 첫번째인수 = 여기서는 hotelInfos라는 모델과의 관계를, 지정 두번째인수 = 익명함수 / wherehas를 사용하는이유(일대다 관계기떄문에 단순히 whereIn을 사용할수없다.) whererha 쓰렴ㄴ
                    $query->whereIn('hc_type', $hcType);  // 동적으로 주어진 $hcType 배열에 포함된 hc_type 값을 가진 데이터만 필터링한다
                    // wherein 첫번째 인수 = 테이블.칼럼명, 두번째인수 = 비교할 배열
                });                                        
            })
            ->whereNotNull('hotels.firstimage') // 사진있는것만 가져오기
            ->select('hotel_id', 'title', 'firstimage') // 호텔아이디, 호텔이름, 사진만 가져오기
            ->orderBy('createdtime', 'desc')    // 파일 업로드한날로 최신순으로 정렬
            ->paginate(32); // 페이지네이션

        // $hotels = Hotel::join('hotel_infos', 'hotels.hotel_id', '=', 'hotel_infos.hotel_id')
        //                 ->join('hotel_categories', 'hotel_infos.hc_type', '=', 'hotel_categories.hc_type')
        //                 ->where(function ($query) {
        //                     $query->where('hotels.cat3', 'B02010100')
        //                           ->orWhere('hotels.cat3', 'B02010700')
        //                           ->orWhere('hotels.cat3', 'B02011100');
        //                 })
        //                 ->when($areaCode, function($query, $areaCode) {
        //                     return $query->whereIn('hotels.area_code', $areaCode);
        //                 })
        //                 ->when($hcType, function($query, $hcType) {
        //                     return $query->whereIn('hotel_infos.hc_type', $hcType);
        //                 })
        //                 ->whereNotNull('hotels.firstimage')
        //                 ->orderBy('createdtime', 'desc')
        //                 ->select('hotels.hotel_id', 'hotels.title', 'hotel_infos.hc_type', 'hotel_categories.hc_name', 'hotels.firstimage', 'hotels.createdtime')
            
        //                 ->paginate(10);


        // $hotels = HotelInfo::join('hotels', 'hotel_infos.hotel_id', '=', 'hotels.hotel_id')
        //                    ->join('hotel_categories', 'hotel_infos.hc_type', '=', 'hotel_categories.hc_type')
        //                    ->where(function ($query) {
        //                         $query->where('cat3', 'B02010100')
        //                               ->orWhere('cat3', 'B02010700')
        //                               ->orWhere('cat3', 'B02011100');
        //                     })
        //                     ->when($areaCode, function($query, $areaCode) {
        //                         return $query->whereIn('area_code', $areaCode);
        //                     })
        //                     ->when($hcType, function($query, $hcType) {
        //                         return $query->whereIn('hotel_infos.hc_type', $hcType);
        //                     })
        //                     ->whereNotNull('firstimage')
        //                     ->orderBy('createdtime', 'desc')
        //                     ->paginate(10);
        //                     // ->dd();

                            
        // $hotels = Hotel::with('hotel_category')
        //     ->whereNotNull('firstimage')
        //     ->orderBy('createdtime', 'desc')
        //     ->paginate(10);


        // $hotels = Hotel::where(function ($query) {
        //     $query->where('cat3', 'B02010100')
        //           ->orWhere('cat3', 'B02010700')
        //           ->orWhere('cat3', 'B02011100');
        // })
        // ->whereNotNull('firstimage')
        // ->orderBy('createdtime', 'desc')
        // ->paginate(32);

        return response()->json($hotels);
    }

    public function areas(Request $request) {
        $areas = Area::get();

        return response()->json($areas);
    }

    public function categories(Request $request) {
        $categories = HotelCategory::get();

        return response()->json($categories);
    }
}
