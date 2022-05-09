<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\ArticleCollection;
use App\Models\v1\Article;
use Illuminate\Http\Request;

class articleController extends Controller
{
    public function getAllArticle(Request $request)
    {
        $article =  Article::with(['authorInfo','category']);
        return $this->responseJson('Success','Success',new ArticleCollection($this->PrepareDataByUrlParam($article,$request->all(),'article')),200);
    }
}
