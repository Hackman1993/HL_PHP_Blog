<?php

namespace App\Http\Middleware;

use App\Exceptions\WebApiException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {

        Log::warning($request->bearerToken());
        throw new WebApiException("Access Denied", 403);
    }
}
