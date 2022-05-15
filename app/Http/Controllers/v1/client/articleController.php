<?php

namespace App\Http\Controllers\v1\client;

use App\Http\Controllers\Controller;
use App\Models\v1\Article;
use App\Services\v1\client\ArticleServices;
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

    public function getArticle($id)
    {
        return $this->ServicesHandler->getArticle($id);
    }

    public function editArticle(Article $article,Request $request)
    {
        return $this->ServicesHandler->editArticle($article,$request->all());
    }

    public function deleteArticle(Article $article)
    {
        return $this->ServicesHandler->deleteArticle($article);
    }

    public function changeStatus(Article $article , Request $request)
    {
        return $this->ServicesHandler->changeStatus($article,$request);
    }
}
