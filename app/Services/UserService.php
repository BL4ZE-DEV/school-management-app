<?php

namespace App\Services;

use Tymon\JWTAuth\Facades\JWTAuth;


class UserService
{
    public function register($request){
        
        $user = \App\Models\User::create($request->all());

        if(!$user){
            throw new \Exception("Error creating user");
        }

        $token = JWTAuth::fromUser($user);

        return ['user' => $user, 'token' => $token];
    }


    public function Tenantlogin($request){
        $credentials = $request->only('email','password');

        auth()->setProvider(app('auth')->createUserProvider('tenants_users'));

        if(!$token = auth()->attempt($credentials)){
            throw new \Exception("Invalid Credentials");
        }

        return "Hey patner, you are logged in successfully";
    }


    public function login($request){
        $credentials = $request->only('email','password');

        if(!auth()->attempt($credentials)){
            throw new \Exception("Invalid Credentials");
        }

        $token = JWTAuth::fromUser(auth()->user());
        
        return ['user' => auth()->user(), 'token' => $token];
    }

    
}