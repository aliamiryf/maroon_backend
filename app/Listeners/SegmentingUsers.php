<?php

namespace App\Listeners;

use App\Events\userReadArticle;
use App\Models\v1\Segment;
use App\Services\v1\admin\segmentServices;
use App\Services\v1\main\jwtServices;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use function Symfony\Component\Translation\t;

class SegmentingUsers
{
    /**
     * Create the event listener.
     *
     * @return void
     */

    public $event;
    public $jwtServices;
    public $segmentServices;


    public function __construct(userReadArticle $event, jwtServices $jwtServices, segmentServices $segmentServices)
    {
        $this->jwtServices = $jwtServices;
        $this->event = $event;
        $this->segmentServices = $segmentServices;
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        $setLogin = $this->event->request->user != null ? true : false;
        $segments = Segment::where('status', true)->with('conditions')->get();
        foreach ($segments as $segment) {
            foreach ($segment->conditions as $condition) {
                $db = DB::table($condition->condition['table'])->where($condition->type . "_id", $condition->condition[$condition->type . "_id"]);
                if ($this->event->request->user != null) {
                    $data = $db->where('user_id', $this->event->request->user->id)->count();
                    if ($condition->condition['count'] == $data) {
                        $this->segmentServices->pushingClientInSegment($segment,$this->event->request->user->id);
                    }
                } else {
                    $data = $db->where('user_id', $this->event->request->user->id)->count();
                    if ($condition->condition['count'] == $data) {
//                        $this->segmentServices->pushingClientInSegment('');
                    }
                }
            }

        }
    }


}
