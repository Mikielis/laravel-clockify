<?php

namespace App\Http\Middleware;

use App\Services\UserActivity\UserActivityService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeenPageLog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Log seen page by authenticated user
        if (Auth::check()) {
            app()->make(UserActivityService::class)->logSeenPage();
        }

        return $next($request);
    }
}
