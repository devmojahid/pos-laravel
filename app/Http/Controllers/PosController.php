<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function index()
    {
        $products = Product::paginate(8);
        return view('scene::pos.index', compact('products'));
    }

    public function getProduct($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }

    public function getProducts(Request $request)
    {
        $searchParam = $request->search;
        $products = Product::query()
            ->where('name', 'LIKE', "%{$searchParam}%")
            ->orWhere('sku', 'LIKE', "%{$searchParam}%")
            ->get();
        return response()->json($products);
    }
}
