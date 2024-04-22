<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\AddOns;
use App\Models\Food;
use App\Models\Order;
use App\Models\User;

class OrderController extends Controller
{
    public function index()
    {
        $orders = $this->getFoodsByUser(auth()->id());
        return OrderResource::collection($orders);
    }

    public function ongoingOrders()
    {
        $ongoingOrders = $this->getFoodsByUser(auth()->id(), false);
        return response()->json($ongoingOrders);
    }

    public function orderHistory()
    {

        $orderHistory = $this->getFoodsByUser(auth()->id(), true);
        return response()->json($orderHistory);
    }

    public function latestOrder()
    {
        $query = Order::where('user_id', auth()->id())->with('foods')->latest()->get();

        return $query;
    }

    public function store()
    {
        request()->validate([
            'beverage' => 'nullable|string',
            'beverage_size' => 'nullable|string',
            'food.*.id' => 'required|exists:food,id',
            'food.*.quantity' => 'required|integer|min:1',
            'add_ons.*.id' => 'nullable|exists:add_ons,id',
            'add_ons.*.quantity' => 'nullable|integer|min:1',
        ]);

        $totalPrice = 0;

        $order = Order::create([
            'user_id' => auth()->id(),
            'beverage' => request('beverage'),
            'beverage_size' => request('beverage_size'),
            'total_price' => $totalPrice,
        ]);

        foreach (request()->foods as $food) {
            $foodItem = Food::findOrFail($food['id']);
            $totalPrice += $foodItem->price * $food['quantity'];
            $order->foods()->attach($food['id'], ['quantity' => $food['quantity']]);
        }

        if (request()->has('add_ons')) {
            foreach (request()->add_ons as $add_on) {
                $orderAddOn = AddOns::findOrFail($add_on['id']);
                $order->orderAddOns()->attach($orderAddOn->id, ['quantity' => $add_on['quantity']]);
                $totalPrice += $orderAddOn->price * $add_on['quantity'];
            }
        }

        $order->total_price = $totalPrice;
        $order->save();

        return response()->json(['message' => 'Order placed successfully']);
    }

    protected function getFoodsByUser($user, $delivered = null)
    {
        $query = Order::where('user_id', $user)->with('foods');

        if ($delivered !== null) {
            $query->whereHas('foods', function ($query) use ($delivered) {
                $query->where('delivered', $delivered);
            });
        }

        return $query->get();
    }

    public function update(Order $order)
    {
        // Validate the request data
        $attributes = request()->validate([
            'delivered' => 'required|boolean',
        ]);

        // Update the delivered status
        $order->update($attributes);

        return response()->json(['message' => 'Delivery status updated successfully'], 200);
    }
}
