<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class ProductController extends Controller
{
    public function products()
    {
        // get all products
        $products = Products::all();
        
        return view('products.products', ['products' => $products]);
    }

    public function product($id)
    {
        $product = Products::find($id);
        
        return view('products.product', ['product' => $product]);
    }
}
