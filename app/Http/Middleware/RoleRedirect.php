<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Symfony\Component\HttpFoundation\Response;

class RoleRedirect
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user) {
            return $next($request);
        }

        $prefix = request()->segment(1);

        $rolePrefixMap = [
            'super-admin' => 'super_admin',
            'admin' => 'admin',
            'anggota' => 'anggota',
            'pengurus' => 'pengurus',
            'pengawas' => 'pengawas',
        ];

        try {
            $expectedRole = $rolePrefixMap[$prefix] ?? null;

            if ($expectedRole && ! $user->hasRole($expectedRole)) {
                return $this->redirectToRoleDashboard($user);
            }
        } catch (RoleDoesNotExist $e) {
            return redirect('/');
        }

        return $next($request);
    }

    private function redirectToRoleDashboard($user): \Illuminate\Http\RedirectResponse
    {
        $roleRoutes = [
            'super_admin' => '/super-admin/dashboard',
            'admin' => '/admin/dashboard',
            'anggota' => '/anggota/dashboard',
            'pengurus' => '/pengurus/dashboard',
            'pengawas' => '/pengawas/dashboard',
        ];

        foreach ($roleRoutes as $role => $path) {
            try {
                if ($user->hasRole($role)) {
                    return redirect($path);
                }
            } catch (RoleDoesNotExist $e) {
                continue;
            }
        }

        return redirect('/dashboard');
    }
}
