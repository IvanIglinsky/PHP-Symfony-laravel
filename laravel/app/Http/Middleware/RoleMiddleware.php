<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): \Symfony\Component\HttpFoundation\Response  $next
     * @param  string  $role
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['message' => 'Not authenticated.'], 401);
        }

        // Перевіряємо, чи роль міститься в масиві ролей користувача
        if (!in_array($role, $user->roles)) {
            return response()->json(['message' => 'Access denied.'], 403);
        }

        return $next($request);
    }
}
