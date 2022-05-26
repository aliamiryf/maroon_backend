<?php

namespace App\Services\v1\client;

use App\Events\userReadArticle;
use App\Http\Resources\v1\ArticleCollection;
use App\Models\v1\Article;
use App\Models\v1\User;
use App\Services\BaseServices;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class ArticleServices extends BaseServices
{
    public $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getAllArticles($request)
    {
        $article = Article::with(['authorInfo', 'category']);
        return $this->responseJson('Success', 'Success', new ArticleCollection($this->PreparePaginationData($article, $request->all())), 200);
    }

    public function createArticle($request)
    {
        $data = $this->validatorData($request->all(), [
            'title' => 'required',
            'primaryPic' => 'required|image',
            'description' => 'required',
            'readTime' => 'number|required',
            'body' => 'required',
        ]);
        return $data;
    }

    public function getArticle($postId)
    {

        $article = Article::findOrFail($postId)->load('category');
        $category = $article->category;
        $tags = $article->tags;
        $this->request->merge(['category'=>$category,'tags'=>$tags]);
        event(new userReadArticle($this->request));

        return $this->responseJson('success', 'success', $article , 200);
    }

    public function editArticle($article, $request)
    {
        try {
            $article->update($request);
            return $this->responseJson('success', 'success', $article, 200);
        } catch (\Exception $exception) {
            return $this->responseJson('failed', 'failed', $exception->getMessage(), 500);
        }
    }

    public function deleteArticle($article)
    {
        try {
            $article->delete();
            return $this->responseJson('success', 'success', ['message' => 'حذف با موفقیت انجام شد'], 200);
        } catch (\Exception $exception) {
            return $this->responseJson('success', 'success', ['message' => 'عملیات حذف با شکست مواجه شد'], 500);
        }
    }

    public function changeStatus($article, $request)
    {
        $data = $this->validatorData($request->all(), [
            'status' => 'required'
        ]);
        if ($data['status']) {
            try {
                $article->update([
                    'status' => $data['data']['stasus']
                ]);
                return $this->responseJson('success', 'success', \App\Http\Resources\v1\Article::make($article), 200);
            } catch (Exception $e) {
                return $this->responseJson('success', 'success', ['message' => 'عملیات  با شکست مواجه شد'], 500);
            }
        }
        return $this->responseJson('success', 'success', ['message' => $data['message']], 401);
    }
}
