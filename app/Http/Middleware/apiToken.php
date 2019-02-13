<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class apiToken
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
        $access_token = trim($request->header('Authorization'));
        //dd($access_token);
        if(!$access_token)
        {
            return response()->json(null, 401);
        }
        $user=User::where('api_token', $access_token)->first();
        if(!$user)
        {
            return response()->json(null, 401);
        }
        return $next($request);
    }
}
