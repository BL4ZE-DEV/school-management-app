<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TenantJwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $tenant = app('tenant');

        $payload = Auth::guard('tenant')->payload();

        $tokenTenantId = $payload->get('tenant_id');

        if((int) $tokenTenantId !== (int) $tenant->id){
            return response()->json([
                'message' => 'unauthorized'
            ],401);
        }

        return $next($request);
    }
}
