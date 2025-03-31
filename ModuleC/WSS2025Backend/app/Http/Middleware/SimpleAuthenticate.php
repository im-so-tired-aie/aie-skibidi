<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SimpleAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the token from the Authorization header
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['message' => 'No token provided.'], 401);
        }

        // Find the user by the token
        $user = User::where('api_token', $token)->first();

        if (!$user) {
            return response()->json(['message' => 'Invalid token.'], 401);
        }

        // Authenticate the user
        auth()->login($user);

        return $next($request); 
    }
    
}
