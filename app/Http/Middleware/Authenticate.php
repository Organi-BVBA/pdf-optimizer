<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  string[]  ...$guards
     *
     * @return mixed
     */
    public function handle($request, \Closure $next, ...$guards)
    {
        if (true === config('auth.disabled') && 'api/url' === $request->route()->uri) {
            return $next($request);
        }

        // @phpstan-ignore-next-line
        return parent::handle($request, $next, ...$guards);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  Request  $request
     *
     * @return null|string
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
