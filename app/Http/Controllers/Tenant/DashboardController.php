<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Services\Tenant\DashboardService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct(
        protected DashboardService $dashboardService
    ) {
    }

    public function index()
    {
        $user = Auth::guard('tenant')->user();

        return response()->json([
            'message' => 'Dashboard loaded successfully.',
            'data' => $this->dashboardService->dashboard($user),
        ]);
    }
}