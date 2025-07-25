<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
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
        $request->authenticate();

        $request->session()->regenerate();
        // 👇 Add dynamic redirect logic here
        $roles = Auth::user()->roles->pluck('name');
        //dd(Auth::user()->roles->pluck('name')->toArray());
        if ($roles->contains('Admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($roles->contains('Human Resource')) {
            return redirect()->route('hr.dashboard');
        } elseif ($roles->contains('Manager')) {
            return redirect()->route('manager.dashboard');
        } elseif ($roles->contains('Employee')) {
            return redirect()->route('employee.dashboard');
        }
        return redirect('/dashboard'); // fallback redirect
        // return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login')->with('status', 'You have been logged out successfully.');
    }
}
