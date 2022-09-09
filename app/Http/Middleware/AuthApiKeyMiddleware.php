<?php

namespace App\Http\Middleware;

use Closure;

class AuthApiKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->hasHeader('authorization')) {

            $bearer_token  = null;
            // does not works if places inside the exceptions
            if ($request->hasHeader('authorization')) {
                $bearer_token = $request->bearerToken();
            }


            try {
                return app(\Illuminate\Auth\Middleware\Authenticate::class)->handle($request, function ($request) use ($next) {
                    return $next($request);
                }, 'api');
            } catch (\Exception $exception) {
                return response()->json([
                    'status' => \auth()->check(),
                    'message' => 'Token or key is not valid',
                ]);
                //return $exception;
            }
        }
    }
}
