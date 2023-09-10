<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->input('q');

        $searchProducts = Products::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->get();


            return view('products.products', compact('searchProducts'));
    }
}