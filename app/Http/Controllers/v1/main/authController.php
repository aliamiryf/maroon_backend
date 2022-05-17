<?php

namespace App\Http\Controllers\v1\main;

use App\Http\Controllers\Controller;
use App\Services\v1\main\authServices;
use Illuminate\Http\Request;

class authController extends Controller
{
    public function __construct(authServices $authServices)
    {
        $this->ServicesHandler = $authServices;
    }

    public function register(Request $request)
    {
        return $this->ServicesHandler->register($request);
    }

    public function loginByUserPass(Request $request)
    {
        return $this->ServicesHandler->loginByUsernamePassword($request);
    }

}
