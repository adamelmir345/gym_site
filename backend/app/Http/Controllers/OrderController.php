<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        return response()->json($request->user()->orders()->with('items.product')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'shipping_address' => 'required|string',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric',
        ]);

        $total = collect($validated['items'])->sum(function ($item) {
            return $item['quantity'] * $item['price'];
        });

        $order = Order::create([
            'user_id' => $request->user()->id,
            'shipping_address' => $validated['shipping_address'],
            'total_amount' => $total,
        ]);

        foreach ($validated['items'] as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        return response()->json(['message' => 'Commande créée', 'order' => $order->load('items')], 201);
    }

    public function show($id, Request $request)
    {
        $order = $request->user()->orders()->with('items.product')->findOrFail($id);
        return response()->json($order);
    }
}