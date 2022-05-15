<?php

namespace App\Services\v1\client;

use App\Http\Resources\v1\categoryCollection;
use App\Models\v1\category;
use App\Services\BaseServices;
use http\Env\Request;
use Illuminate\Support\Str;

class categoryServices extends BaseServices
{
    public function getAllCategory($request)
    {
        $cate = category::withCount('articleCount');
        return $this->responseJson('success','success',new categoryCollection($this->PreparePaginationData($cate,$request)),200);
    }

    public function createCategory($request)
    {
       $data = $this->validatorData($request->all(),[
           'title'=>'required',
           'slug'=>''
       ]);
       if ($data['status']){
           $category = category::create([
               'title'=>$data['data']['title'],
                'slug'=>$data['data']['slug'] ?? str_slug($data['data']['title'])
           ]);
           return $this->responseJson('success','success',\App\Http\Resources\v1\Category::make($category),200);
       }
       return $this->responseJson('success','success',$data['message'],401);
    }

    public function editCategory($category,$request)
    {
        $data = $this->validatorData($request->all(),[
            'status'=>'in:public,private',
            'title'=>'',
            'slug'=>'',
        ]);
        $category->update([
            'title'=>$data['data']['title'] ?? $category->title,
            'status'=>$data['data']['status'] ?? $category->status,
            'slug'=>$data['data']['slug'] ?? $category->status,
        ]);
        return $category;
    }

    public function deleteCategory($category)
    {
        return $category->delete();
    }
}
