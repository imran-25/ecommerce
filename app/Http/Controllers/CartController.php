<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
       $items = auth()->user()->cartItems;
       $categories = Category::all();

       return view('cart-items', compact('items', 'categories'));
    }

    public function store(Request $request)
    {
        Cart::create([
            'product_id' => $request->product_id,
            'qty' => $request->qty,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->back();
    }
}
