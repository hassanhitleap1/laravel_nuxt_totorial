<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\User as UserResources;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * @param UserLoginRequest $request
     * @return UserResources|\Illuminate\Http\JsonResponse
     */
    public function index(UserLoginRequest $request)
    {
        if(!$token=auth()->attempt($request->only('email','password'))){
            return response()->json([
                'error'=>[
                    'error must be shure user name or email'
                ]
            ]);
        }

        return  (new UserResources($request->user()))->additional([
            'meta'=>[
                'token'=>$token,
            ],
        ]);

    }

    public function user(Request $request){
        return new UserResources($request->user());
    }

    public  function  login(){
        auth()->logout();
    }
}
