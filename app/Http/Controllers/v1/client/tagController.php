<?php

namespace App\Http\Controllers\v1\client;

use App\Http\Controllers\Controller;
use App\Services\v1\client\tagServices;
use Illuminate\Http\Request;

class tagController extends Controller
{
    public function __construct(tagServices $services)
    {
        $this->ServicesHandler = $services;
    }

    public function getAllTag()
    {
        return $this->ServicesHandler->getAllTag();
    }

    public function createTag(Request $request)
    {
        return $this->ServicesHandler->createTag($request);
    }
}
