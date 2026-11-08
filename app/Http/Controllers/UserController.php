<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(StoreUserRequest $request)
    {
        $data = $this->userService->register($request);

        return response()->json($data, 201);
    }

    public function login(Request $request)
    {
        $data = $this->userService->login($request);

        return response()->json($data, 200);
    }

    public function Tenantlogin(Request $request)
    {
        $data = $this->userService->Tenantlogin($request);

        return response()->json($data, 200);
    }
}

