<?php

namespace App\Http\Controllers\v1\client;

use App\Http\Controllers\Controller;
use App\Models\v1\category;
use App\Services\v1\client\categoryServices;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    public function __construct(categoryServices $categoryServices)
    {
        $this->ServicesHandler = $categoryServices;
    }

    public function getAllCategory(Request $request)
    {
        return $this->ServicesHandler->getAllCategory($request);
    }
}
