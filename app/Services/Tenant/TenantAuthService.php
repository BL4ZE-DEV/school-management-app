<?php

 namespace App\Services\Tenant;

use Illuminate\Support\Facades\Auth;

class TenantAuthService
{
    public function authenticate($request)
    {
        $credentials = $request->only('email', 'password');

        if (! $token = Auth::guard('tenant')->attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }

        $user = Auth::guard('tenant')->user();

        return response()->json([
            'message' => 'Authentication successful',
            'token' => $token,
            'user' => $user,
        ]);
    }
    
    public function logout(): void
    {
        Auth::guard('tenant')->logout();
    }

    public function refresh()
    {
        return Auth::guard('tenant')->refresh();
    }

    public function user()
    {
        return Auth::guard('tenant')->user();
    }
}