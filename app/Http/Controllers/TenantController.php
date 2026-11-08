<?php

namespace App\Http\Controllers;

    
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTenantRequest;
use App\Http\Requests\UpdateTenantRequest;
use App\Services\TenantService;

class TenantController extends Controller
{
    protected $tenantService;

    public function __construct(TenantService $tenantService)
    {
        $this->tenantService = $tenantService;
    }

    public function store(StoreTenantRequest $request)
    {
        $tenant = $this->tenantService->store($request);

        return response()->json($tenant, 201);
    }

}
