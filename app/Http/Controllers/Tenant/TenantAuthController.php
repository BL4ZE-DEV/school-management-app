<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Services\Tenant\TenantAuthService;

class TenantAuthController extends Controller
{
    protected $tenantAuthService;

    public function __construct(TenantAuthService $tenantAuthService)
    {
        $this->tenantAuthService = $tenantAuthService;
    }

    public function login(\Illuminate\Http\Request $request){

        return $this->tenantAuthService->authenticate($request);
    }

}