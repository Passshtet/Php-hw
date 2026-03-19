<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $orders = auth()->user()->orders()->with('items.product')->latest()->get();
        return view('orders.index', compact('orders'));
    }


    public function create()
    {
        $products = Product::all();
        return view('orders.create', compact('products'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'items'              => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity'   => 'required|integer|min:1',
        ]);


        $orderNumber = 'ORD-' . strtoupper(uniqid());

        $order = Order::create([
            'order_number' => $orderNumber,
            'user_id'      => auth()->id(),
            'order_date'   => now(),
        ]);


        foreach ($validated['items'] as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item['product_id'],
                'quantity'   => $item['quantity'],
            ]);
        }

        return redirect()->route('orders.index')->with('success', 'Заказ #' . $orderNumber . ' создан.');
    }
}
