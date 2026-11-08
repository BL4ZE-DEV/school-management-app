<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class TenantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $subdomain = explode('.', $request->gethost())[0];

        $tenant = Tenant::where('subdomain', $subdomain)->firstOrFail();

        config()->set('database.connections.tenant.database', $tenant->database);
        
        app()->instance('tenant', $tenant);
        
        DB::purge('tenant');
        DB::reconnect('tenant');

        return $next($request);
    }
}
