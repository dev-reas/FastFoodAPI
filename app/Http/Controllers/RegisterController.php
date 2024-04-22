<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;

class RegisterController extends Controller
{
    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'address' => 'required|min:10|max:255',
            'number' => 'required|digits_between:7,12',
            'password' => 'required|min:7|max:255',
        ]);

        $user = User::create($attributes);

        return response()->json([
            'message' => 'User Created ',
        ], 201);
    }
}
