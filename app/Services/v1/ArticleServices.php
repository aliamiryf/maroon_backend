<?php

namespace App\Services\v1;

use App\Http\Resources\v1\ArticleCollection;
use App\Models\v1\Article;
use App\Services\BaseServices;

class ArticleServices extends BaseServices
{
    public function getAllArticles($request){
        $article =  Article::with(['authorInfo','category']);
        return $this->responseJson('Success','Success',new ArticleCollection($this->PreparePaginationData($article,$request->all())),200);
    }

    public function createArticle($request){
        $data = $this->validatorDate($request->all(),[
            'title'=>'required',
            'primaryPic'=>'required|image',
            'description'=>'required',
            'readTime'=>'number|required',
            'body'=>'required',
        ]);
        return $data;
    }
}
