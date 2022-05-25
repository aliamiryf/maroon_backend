<?php

namespace App\Services\v1\client;

use App\Exceptions\v1\invalidDateException;
use App\Http\Resources\v1\TagCollection;
use App\Models\v1\Tag;
use App\Services\BaseServices;
use Illuminate\Http\Request;

class tagServices extends BaseServices
{
    public function getAllTag(){
        return $this->responseJson('200','success',new TagCollection(Tag::with('parentCategory')->paginate(10)),'200');
    }
    public function createTag($request){
        $data = $this->validatorData($request->all(),[
            'title'=>'required',
            'slug'=>'required',
            'category_id'=>'required',
        ]);
        if ($data['status']){
            $tag = Tag::create([
                'title'=>$data['data']['title'],
                'slug'=>$data['data']['slug'],
                'category_id'=>$data['data']['category_id'],
            ]);
            return $this->responseJson('success','success',\App\Http\Resources\v1\Tag::make($tag),200);
        }
        throw new invalidDateException($data['message']);
    }

    public function deleteTag($tag)
    {
        $tag->delete();
        return $this->responseJson('success','success',[],'200');
    }
}
