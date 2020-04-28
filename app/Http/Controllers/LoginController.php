<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\User as UserResources;

class LoginController extends Controller
{
    public function index(UserLoginRequest $request)
    {
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
