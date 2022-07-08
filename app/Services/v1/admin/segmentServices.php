<?php

namespace App\Services\v1\admin;

use App\Http\Resources\v1\segmentCollection;
use App\Models\v1\Segment;
use App\Models\v1\SegmentCondition;
use App\Services\BaseServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class segmentServices extends BaseServices
{
    public function getAllSegment()
    {
        $segments = Segment::withCount('users')->with('conditions')->get();
        return $this->responseJson('success', 'success', new segmentCollection($segments), '200');
    }

    public function createSegment($request)
    {
        $segment = Segment::create([
            'name' => $request['name'],
        ]);
        $param = $this->prepareConditions($request);
        return $segment->conditions()->create([
            'condition' => json_encode($param),
            'type' => 'category'
        ]);
    }

    private function prepareConditions($params)
    {
        $final_param = [];
        $keys = array_keys($params);
        foreach ($keys as $key) {
            if (array_search('tag_id', SegmentCondition::$rules) > -1) {
                $final_param[$key] = $params[$key];
            }
        }
        return $final_param;
    }

    public function pushingClientInSegment(Segment $segment, $userID = null, $tokenID = null)
    {
        $userExitsInSegments = $this->checkClientExistsInSegment($segment->id, $userID, $tokenID);
        if (!$userExitsInSegments) {
            if ($userID != null){
                $segment->users()->attach($userID);
            }else{
                DB::table('segment_user')->insert([
                    'token_id'=>$tokenID,
                    'segment_id'=>$segment->id,
                ]);
            }
        }
    }

    public function checkClientExistsInSegment($segmentID, $userID = null, $tokenID = null)
    {
        $segment = Segment::find($segmentID);
        if ($userID != null) {
            $segmentUsers = $segment->users;
            if (!empty($segmentUsers)) {
                foreach ($segmentUsers as $user) {
                    if ($userID == $user->id) {
                        return true;
                    }
                }
            }
            return false;
        } else {
            $data = DB::table('segment_user')->where('segment_id', $segment->id)->where('token_id', $tokenID)->get();
            if (!empty($data)) {
                foreach ($data as $user) {
                    if ($tokenID == $user->token_id) {
                        return true;
                    }
                }
            }
            return false;
        }
    }
}
