<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

class CheckEmail
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
        \Log::info($user);
        return $user->validEmail ? $next($request) : response()->json(['error' => 'You need to valid your Email address. Go check your mail NOW & click on the link!!!'], 403);    
    }
}