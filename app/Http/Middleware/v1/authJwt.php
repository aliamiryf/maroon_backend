<?php

namespace App\Http\Middleware\v1;

use App\Exceptions\v1\unauthenticated;
use App\Models\v1\User;
use App\Services\v1\main\authServices;
use Closure;
use Illuminate\Http\Request;

class authJwt
{
    public $authServices;
    public function __construct(authServices $authServices)
    {
        $this->authServices = $authServices;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (array_key_exists('authorization',$request->header())){
            $userId = $this->authServices->translateToken($request->header('authorization'));
            $user = User::find($userId);
            $request->merge(['user' => $user]);
            return $next($request);
        }
        throw new unauthenticated('unauthenticated');
    }
}
