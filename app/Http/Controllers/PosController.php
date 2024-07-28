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
}
