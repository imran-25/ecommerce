<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            $orderData = [
                'user_id' => auth()->user()->id,
                'shipping_address' => $request->shipping_address,
                'contact_number' => $request->contact_number
            ];

            $order = Order::create($orderData);

            foreach($request->product_id as $key => $productId) {

                $qty = $request->qty[$key];

                $product = Product::findOrFail($productId);

                $orderItemData = [
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'unit_price' => $product->price,
                    'qty' => $qty
                ];

                OrderItem::create($orderItemData);

            }

            auth()->user()->cartItems()->delete();

            DB::commit();

            return redirect()->route('orders.success');

        }catch(\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    public function orderSuccess()
    {
        return view('order-success');
    }
}
