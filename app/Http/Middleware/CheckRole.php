<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // Redirect sesuai role user
        if ($user->role === 'mentor') {
            return redirect('/dashboard')->with('error', 'Anda tidak punya akses ke halaman tersebut.');
        } elseif ($user->role === 'peserta') {
            return redirect('/participant/materials')->with('error', 'Anda tidak punya akses ke halaman tersebut.');
        }

        // Default jika role tidak dikenali
        abort(403, 'Unauthorized action.');
    }
}
