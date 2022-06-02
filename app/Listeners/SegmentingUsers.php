<?php

namespace App\Listeners;

use App\Events\userReadArticle;
use App\Models\v1\Segment;
use App\Services\v1\main\jwtServices;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class SegmentingUsers
{
    /**
     * Create the event listener.
     *
     * @return void
     */

    public $event;
    public $jwtServices;

    public function __construct(userReadArticle $event, jwtServices $jwtServices)
    {
        $this->jwtServices = $jwtServices;
        $this->event = $event;
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
           foreach ($segment->conditions as $condition){
               if ($this->event->request->user != null) {
                   $db = DB::table($condition->condition->table)->where($condition->type."_id",$condition[$condition->type."_id"])->get();
                   return $db;
               }
           }

        }
    }


}
