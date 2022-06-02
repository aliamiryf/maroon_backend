<?php

namespace App\Http\Middleware;

use App\Models\v1\TemporaryToken;
use App\Services\v1\main\jwtServices;
use Closure;
use Illuminate\Http\Request;

class mainMiddleware
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
        $jwt = new jwtServices();
        if ($request->header('Authorization') != null){
            if ($request->user == null){
              $user =  $jwt->translateTokenAndFindUser($request->header('Authorization'));
              $request->merge(['user'=>$user]);
            }
        }else{
            if ($request->header('user_temporary_token') != null){
                $token = TemporaryToken::where('token',$request->header('user_temporary_token'))->first();
                $request->merge(['token'=>$token]);
            }
        }
        return $next($request);
    }
}
