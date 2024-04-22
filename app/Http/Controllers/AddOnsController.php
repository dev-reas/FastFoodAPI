<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\AddOnsResource;
use App\Models\AddOns;
use Illuminate\Http\Request;

class AddOnsController extends Controller
{
    public function index()
    {
        return AddOnsResource::collection(AddOns::all());
    }

    public function show(AddOns $addons)
    {
        return AddOnsResource::make($addons);
    }
}
