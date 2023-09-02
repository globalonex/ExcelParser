<?php

namespace App\Http\Middleware;

use App\Models\ApiToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BasicAuth
{
    private function isValidApiKey($apiKey)
    {
        return ApiToken::where('token', $apiKey)->exists();
    }

    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('Authorization');

        if ($apiKey && $this->isValidApiKey($apiKey)) {
            return $next($request);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }
}
