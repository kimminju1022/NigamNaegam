<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductMainController extends Controller
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
        $productList = Product::where('contenttypeid', $contentTypeId)
                                ->when($areaCode, function($query, $areaCode) {
                                    return $query->whereIn('products.area_code', $areaCode);
                                })
                                ->whereNotNull('firstimage')
                                ->select('product_id', 'title', 'firstimage')
                                ->orderBy('createdtime', 'desc')
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
}
