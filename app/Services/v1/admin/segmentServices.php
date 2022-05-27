<?php

namespace App\Services\v1\admin;

use App\Http\Resources\v1\segmentCollection;
use App\Models\v1\Segment;
use App\Services\BaseServices;
use Illuminate\Http\Request;

class segmentServices extends BaseServices
{
    public function getAllSegment()
    {
        $segments = Segment::withCount('users')->with('conditions')->get();
        return $this->responseJson('success','success',new segmentCollection($segments),'200');
    }


}
