<?php

namespace App\Services\v1\client;

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
        return $data;
    }
}
