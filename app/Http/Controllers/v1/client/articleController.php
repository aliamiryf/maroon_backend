<?php

namespace App\Http\Controllers\v1\client;

use App\Events\userReadArticle;
use App\Http\Controllers\Controller;
use App\Models\v1\Article;
use App\Models\v1\category;
use App\Services\v1\client\ArticleServices;
use Illuminate\Http\Request;

class articleController extends Controller
{
    public $request;
    public function __construct(ArticleServices $services,Request $request)
    {
        $this->request = $request;
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
