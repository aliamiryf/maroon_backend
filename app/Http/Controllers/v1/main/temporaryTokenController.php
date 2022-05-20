<?php

namespace App\Http\Controllers\v1\main;

use App\Http\Controllers\Controller;
use App\Services\v1\main\temporaryTokenServices;
use Illuminate\Http\Request;

class temporaryTokenController extends Controller
{
    public function __construct(temporaryTokenServices $services)
    {
        $this->ServicesHandler = $services;
    }

    public function generateToken()
    {
       return $this->ServicesHandler->generateToken();
    }
}
