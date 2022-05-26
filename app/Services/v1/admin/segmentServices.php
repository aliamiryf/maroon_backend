<?php

namespace App\Services\v1\admin;

use App\Http\Resources\v1\segmentCollection;
use App\Models\Segment;
use App\Services\BaseServices;

class segmentServices extends BaseServices
{
    public function getAllSegment()
    {
        $segments = Segment::all();
        return $this->responseJson('success','success',new segmentCollection($segments),'200');
    }
}
