<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;

class JwtMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            $payload = JWTAuth::parseToken()->getPayload();
            $request->merge([
                'user_id' => $payload->get('sub'),
                'role' => $payload->get('role') // 1 - admin, 2 - regular
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Token Invalid or Missing: ' . $e], 401);
        }

        return $next($request);
    }
}
