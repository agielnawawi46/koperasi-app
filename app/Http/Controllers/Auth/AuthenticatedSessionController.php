<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Spatie\Permission\Exceptions\RoleDoesNotExist;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = $request->user();

        try {
            if ($user->hasRole('super_admin')) {
                return redirect()->intended(route('super-admin.dashboard'));
            }

            if ($user->hasRole('admin')) {
                return redirect()->intended(route('admin.dashboard'));
            }

            if ($user->hasRole('anggota')) {
                return redirect()->intended(route('anggota.dashboard'));
            }

            if ($user->hasRole('pengurus')) {
                return redirect()->intended(route('pengurus.dashboard'));
            }

            if ($user->hasRole('pengawas')) {
                return redirect()->intended(route('pengawas.dashboard'));
            }
        } catch (RoleDoesNotExist $e) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        return redirect()->intended(route('dashboard', absolute: false));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
