<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegistrarRequest;
use App\User;
use App\Http\Resources\User as UserResources;

class RegistrarController extends Controller
{
    //
    public function index(UserRegistrarRequest $request)
    {

       $user= User::create([
            'email'=>$request->email,
            'name'=>$request->name,
            'password'=> bcrypt($request->password),
        ]);
        if(!$token=auth()->attempt($request->only('email','password'))){
            return abort(401);
        }

        return  (new UserResources($request->user()))->additional([
            'meta'=>[
                'token'=>$token,
            ],
        ]);
    }
}

