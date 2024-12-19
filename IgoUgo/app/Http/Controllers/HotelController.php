<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function hotels() {
        $hotels = Hotel::where(function ($query) {
            $query->where('cat3', 'B02010100')
                  ->orWhere('cat3', 'B02010700')
                  ->orWhere('cat3', 'B02011100');
        })
        ->whereNotNull('firstimage')
        ->limit(10)
        ->get();

        return response()->json($hotels);
    }
}
