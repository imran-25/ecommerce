<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class FrontendController extends Controller
{
    public function homepage()
    {
        $categories = Category::all();
        $products = Product::latest()->take(9)->get();

        return view('homepage', compact('categories', 'products'));
    }

    public function categoryWiseProduct($slug)
    {
       $category = Category::with('products')->where('slug', $slug)->firstOrFail();
       $categories = Category::all();

       return view('categorywise-products', compact('category', 'categories'));
    }

    public function productDetails($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $categories = Category::all();

        return view('product-details', compact('product', 'categories'));
    }

    public function dashboard()
    {
        $categories = Category::all();
        return view('customer-dashboard', compact('categories'));
    }
}


