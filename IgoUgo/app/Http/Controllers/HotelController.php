<?php

namespace App\Http\Controllers;

use App\Models\HotelInfo;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function hotels() {

        $hotels = HotelInfo::with(['hotel.hotelCategory']) // with은 그냥 로드만해주고 결국 ->join 해줘야 조인되긴함함
            ->join('hotels', 'hotel_infos.hotel_id', '=', 'hotels.hotel_id')
            ->join('hotel_categories', 'hotel_infos.hc_id', '=', 'hotel_categories.hc_id')
            ->where(function ($query) {
                $query->where('cat3', 'B02010100')
                      ->orWhere('cat3', 'B02010700')
                      ->orWhere('cat3', 'B02011100');
            })
            ->whereNotNull('firstimage')
            ->orderBy('createdtime', 'desc')
            ->paginate(32);

            function filterHotels(Request $request) {
                $filters = $request->input('filters');
                return response()->json($filters);
            }

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
}
