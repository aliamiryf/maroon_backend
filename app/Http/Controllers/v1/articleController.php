<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Services\v1\ArticleServices;
use Illuminate\Http\Request;

class articleController extends Controller
{
    public function __construct(ArticleServices $services)
    {
        $this->ServicesHandler = $services;
    }

    public function getAllArticle(Request $request)
    {
        return $this->ServicesHandler->getAllArticles($request);
    }
    public function createArticle(Request $request){
        return $this->ServicesHandler->createArticle($request);
    }
}
