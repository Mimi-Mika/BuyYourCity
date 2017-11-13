<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

class CheckBan
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
        $user = Auth::guard('api')->user();
        return !$user->ban ? $next($request) : response()->json(['error' => 'Forbidden. U are ban . . . NOOB Cheater! AHAH!!!'], 403);
    }
}
