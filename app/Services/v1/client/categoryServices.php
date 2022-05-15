<?php

namespace App\Services\v1\client;

use App\Http\Resources\v1\categoryCollection;
use App\Models\v1\category;
use App\Services\BaseServices;

class categoryServices extends BaseServices
{
    public function getAllCategory($request)
    {
        $cate = category::withCount('articleCount');
        return $this->responseJson('success','success',new categoryCollection($this->PreparePaginationData($cate,$request)),200);
    }
}
