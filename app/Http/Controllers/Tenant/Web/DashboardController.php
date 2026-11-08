<?php

namespace App\Http\Controllers\Tenant\Web;

use App\Http\Controllers\Controller;
use App\Services\Tenant\DashboardService;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __construct(
        protected DashboardService $dashboardService
    ) {
    }

    public function index()
    {
        $user = Auth::guard('tenant_web')->user();

        return Inertia::render(
            'Dashboard/Index',
            [
                'dashboard' =>
                    $this->dashboardService
                        ->dashboard($user),
            ]
        );
    }
}