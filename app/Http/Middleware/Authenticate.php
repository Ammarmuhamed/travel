<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        abort(response()->json([
            'endpointName' => app('request')->route()->getName(),
            'is_success' => false,
            'status_code' => 401,
            'message' => "Unauthenticated, please login first",
        ], 401));
    }
}