<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|unique:user',
            'name' => 'required',
            'password' => 'required',
        ]);

        User::create([
            'email'=>$request->email,
            'name'=>$request->name,
            'password'=> bcrypt($request->password),
        ]);
    }
}
