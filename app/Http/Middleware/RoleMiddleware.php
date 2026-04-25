<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        if (!in_array($user->role, $roles)) {
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }
            if ($user->isMember()) {
                return redirect()->route('member.dashboard');
            }
            abort(403, 'Akses tidak diizinkan.');
        }

        return $next($request);
    }
}
