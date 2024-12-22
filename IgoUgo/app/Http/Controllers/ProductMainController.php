<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductMainController extends Controller
{
    public function getFilteredProducts() {
        $products = [
            'spot' => Product::where('contenttypeid', '12')->whereNotNull('firstimage')->inRandomOrder()->limit(5)->get(),
            'culture' => Product::where('contenttypeid', '14')->whereNotNull('firstimage')->inRandomOrder()->limit(5)->get(),
            'sports' => Product::where('contenttypeid', '28')->whereNotNull('firstimage')->inRandomOrder()->limit(5)->get(),
            'shopping' => Product::where('contenttypeid', '38')->whereNotNull('firstimage')->inRandomOrder()->limit(5)->get(),
            'restaurant' => Product::where('contenttypeid', '39')->whereNotNull('firstimage')->inRandomOrder()->limit(5)->get(),
        ];

        return response()->json($products);
    }
}
