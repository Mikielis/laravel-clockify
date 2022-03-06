<?php

namespace App\Http\Middleware;

use App\Services\UserPermission\UserAccessCheck;
use Closure;
use Illuminate\Http\Request;

class CheckAccessPermission
{
    public function __construct(protected UserAccessCheck $userAccessCheck)
    {}

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (\Auth::check()) {
            $isAllowed = $this->userAccessCheck->can($request->route()->getName());

            // Access forbidden
            if (!$isAllowed) {
                abort(403);
            }
        }

        return $next($request);
    }
}
