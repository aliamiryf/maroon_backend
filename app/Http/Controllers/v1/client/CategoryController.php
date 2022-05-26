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

    public function createCategory(Request $request)
    {
        return $this->ServicesHandler->createCategory($request);
    }

    public function editCategory(category $category,Request $request)
    {
        return $this->ServicesHandler->editCategory($category,$request);
    }

    public function deleteCategory(category $category)
    {
        return $this->ServicesHandler->deleteCategory($category);
    }
}

