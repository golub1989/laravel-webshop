<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $category_id = $request->query('category_id');

        if ($category_id) {
            $category = Category::findOrFail($category_id);
            $products = $category->products;
            return view('home.products_by_category', compact('category', 'products'));
        }

        $randomProducts = Products::inRandomOrder()->limit(4)->get();
        $categories = Category::all();

        return view('home.index', compact('randomProducts', 'categories'));
    }

}