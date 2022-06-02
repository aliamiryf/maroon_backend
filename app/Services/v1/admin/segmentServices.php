<?php

namespace App\Services\v1\admin;

use App\Http\Resources\v1\segmentCollection;
use App\Models\v1\Segment;
use App\Models\v1\SegmentCondition;
use App\Services\BaseServices;
use Illuminate\Http\Request;

class segmentServices extends BaseServices
{
    public function getAllSegment()
    {
        $segments = Segment::withCount('users')->with('conditions')->get();
        return $this->responseJson('success','success',new segmentCollection($segments),'200');
    }

    public function createSegment($request)
    {
        $segment = Segment::create([
            'name'=>$request['name'],
        ]);
        $param =  $this->prepareConditions($request);
        return $segment->conditions()->create([
            'condition'=>json_encode($param),
            'type'=>'category'
        ]);
    }

    private function prepareConditions($params)
    {
        $final_param = [];
        $keys =  array_keys($params);
        foreach ($keys as $key){
            if (array_search('tag_id',SegmentCondition::$rules) > -1){
                $final_param[$key] = $params[$key];
            }
        }
        return $final_param;
    }

}
