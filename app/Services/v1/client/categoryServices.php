<?php

namespace App\Services\v1\client;

use App\Exceptions\v1\invalidDateException;
use App\Http\Resources\v1\categoryCollection;
use App\Models\v1\category;
use App\Services\BaseServices;
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
        throw new invalidDateException($data['message']);
    }

    public function editCategory($category,$request)
    {
        $data = $this->validatorData($request->all(),[
            'status'=>'in:public,private',
            'title'=>'',
            'slug'=>'',
        ]);
        try {
            $category->update([
                'title'=>$data['data']['title'] ?? $category->titsle,
                'status'=>$data['data']['status'] ?? $category->status,
                'slug'=>$data['data']['slug'] ?? $category->status,
            ]);
            return $this->responseJson('200','success',\App\Http\Resources\v1\Category::make($category),200);
        }catch (\Exception $exception){
            return $this->responseJson('500','failed',['message'=>$exception->getMessage()],500);
        }

    }

    public function deleteCategory($category)
    {
        return $category->delete();
    }
}
