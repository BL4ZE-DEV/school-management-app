<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Services\Tenant\TenantUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TenantUserController extends Controller
{
    private  $tenantUserService;
    
    public function __construct(TenantUserService $tenantUserService)
    {
        $this->tenantUserService = $tenantUserService;
    }


    // public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:tenant_users',
    //         'password' => 'required|string|min:8|confirmed',
    //         'role' => 'required|string|in:student,teacher,admin',
    //     ]);

    //     $tenantUser = $this->tenantUserService->creatTenantuser($data);

    //     return response()->json(['user' => $tenantUser], 201);
    // }
    
    public function me(){
        
        $user = Auth::guard('tenant');

        dd($user);

        return response()->json(['user' => $user, 'roles' => $user->roles->pluck('name')], 200);
    }

    public function logout()
    {
        Auth::guard('tenant')->logout();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }

    public function refresh()
    {
        $token = Auth::guard('tenant')->refresh();

        return response()->json([
            'message' => 'Token refreshed successfully',
            'token' => $token,
        ]);
    }
}
