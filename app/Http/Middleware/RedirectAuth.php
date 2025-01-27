<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        // Jika guards kosong, set ke array dengan nilai null
        $guards = empty($guards) ? [null] : $guards;

        // Cek apakah user sudah login dengan salah satu guard
        foreach ($guards as $guard) {
            $user = Auth::guard($guard)->user();

            // Jika user sudah login, cek role-nya dan arahkan ke route sesuai role
            if ($user) {
                switch ($user->role) {
                    case 'admin':
                        return redirect()->route('admin.dashboard');
                    case 'petugas':
                        return redirect()->route('petugas.dashboard');
                    case 'user':
                        return redirect()->route('user.book.index');
                    default:
                        return $next($request);  // Jika role tidak dikenali, lanjutkan request
                }
            }
        }

        // Jika tidak ada user yang terautentikasi, lanjutkan request
        return $next($request);
    }
}
