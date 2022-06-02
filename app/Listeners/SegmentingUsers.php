<?php

namespace App\Listeners;

use App\Events\userReadArticle;
use App\Services\v1\main\jwtServices;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        dd($this->event->request->user);
    }

    public function getUserInfoForSegment()
    {

    }
}
