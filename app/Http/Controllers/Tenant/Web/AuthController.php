<?php

namespace App\Http\Controllers\Tenant\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function create()
    {
        return Inertia::render('Auth/Login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => [
                'required',
                'email',
            ],

            'password' => [
                'required',
                'string',
            ],
        ]);

        if (! Auth::guard('tenant_web')->attempt(
            $credentials,
            $request->boolean('remember')
        )) {
            return back()->withErrors([
                'email' => 'Invalid email or password.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->route('tenant.dashboard', [
            'tenant' => $request->route('tenant'),
        ]);  
    }

    public function destroy(Request $request)
    {
        Auth::guard('tenant_web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('tenant.dashboard', [
            'tenant' => $request->route('tenant'),
        ]);  
    }
}