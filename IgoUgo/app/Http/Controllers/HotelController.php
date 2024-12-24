<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\HotelInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HotelController extends Controller
{
    public function hotels(Request $request) {
        Log::debug('request', $request->all());
        $hotels = HotelInfo::join('hotels', 'hotel_infos.hotel_id', '=', 'hotels.hotel_id')
                           ->join('hotel_categories', 'hotel_infos.hc_type', '=', 'hotel_categories.hc_type')
                           ->where(function ($query) {
                                $query->where('cat3', 'B02010100')
                                      ->orWhere('cat3', 'B02010700')
                                      ->orWhere('cat3', 'B02011100');
                            })
                            ->whereNotNull('firstimage')
                            ->orderBy('createdtime', 'desc')
                            ->paginate(10);

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
}
