<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\HotelCategory;
use App\Models\HotelInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HotelController extends Controller
{
    public function hotels(Request $request) {
        Log::debug('request', $request->all());
        $areaCode = $request->area_code;
        $hcType = $request->hc_type;
        // Log::debug('hcType', $hcType);

        $hotels = HotelInfo::join('hotels', 'hotel_infos.hotel_id', '=', 'hotels.hotel_id')
                           ->join('hotel_categories', 'hotel_infos.hc_type', '=', 'hotel_categories.hc_type')
                           ->where(function ($query) {
                                $query->where('cat3', 'B02010100')
                                      ->orWhere('cat3', 'B02010700')
                                      ->orWhere('cat3', 'B02011100');
                            })
                            ->when($areaCode, function($query, $areaCode) {
                                return $query->whereIn('area_code', $areaCode);
                            })
                            ->when($hcType, function($query, $hcType) {
                                return $query->whereIn('hotel_infos.hc_type', $hcType);
                            })
                            ->whereNotNull('firstimage')
                            ->orderBy('createdtime', 'desc')
                            ->paginate(10);
                            // ->dd();

                            
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
