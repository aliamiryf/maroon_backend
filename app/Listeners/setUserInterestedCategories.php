<?php

namespace App\Listeners;

use App\Events\userReadArticle;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class setUserInterestedCategories
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public $event;
    public function __construct(userReadArticle $event)
    {
        $this->event = $event;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\userReadArticle  $event
     * @return void
     */
    public function handle()
    {
        dd($this->event->request->header());
    }
}
