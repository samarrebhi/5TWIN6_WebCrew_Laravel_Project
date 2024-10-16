<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Attempt to authenticate the user
        $request->authenticate();

        // Check if the authenticated user is blocked
        if (Auth::user()->blocked) {
            // Logout the user and redirect with an error message
            Auth::logout(); // Log the user out
            return redirect()->route('login')->withErrors([
                'blocked' => 'Your account has been blocked. Please contact support.',
            ]);
        }

        $request->session()->regenerate();

        // Redirect based on user role
        if (Auth::user()->hasRole('admin')) {
            return redirect('/admin');
        }

        if (Auth::user()->hasRole('client')) {
            return redirect('/home');
        }

        // Default redirect
        return redirect('/home');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
