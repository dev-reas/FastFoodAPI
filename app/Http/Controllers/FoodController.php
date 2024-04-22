<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\FoodResource;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->input('category');

        $query = $category ? Food::filter(['category' => $category]) : Food::query();

        return FoodResource::collection($query->with('category')->latest()->get());
    }

    public function show(Food $food)
    {
        return FoodResource::make($food);
    }
}
