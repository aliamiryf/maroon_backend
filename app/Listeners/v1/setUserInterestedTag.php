<?php

namespace App\Listeners\v1;

use App\Events\userReadArticle;
use App\Listeners\baseUserInterestedMethods;
use App\Models\v1\TemporaryToken;
use App\Models\v1\User;
use App\Services\v1\main\jwtServices;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class setUserInterestedTag extends baseUserInterestedMethods
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
    public function handle()
    {
        if ($this->event->request->header('authorization') != null) {

            $this->setTagLoginUser();

        } else if ($this->event->request->header('user_temporary_token') != null) {


            $this->setTagGuestUser();
        }
    }

    public function setTagLoginUser()
    {
        $token = str_replace('Bearer ', '', (string)$this->event->request->header('authorization'));


        $user = $this->jwtServices->translateToken($token);


        foreach ($this->event->request->tags as $tag) {

            if (!$this->checkItExists($tag->id, $user->userId, 'user_interested_tag', 'tag_id')) {
                User::find($user->userId)->userInterestedTag()->attach([$tag->id]);
            }

        }
    }

    public function setTagGuestUser()
    {
        $token = TemporaryToken::where('token', $this->event->request->header('user_temporary_token'))->first();

        $table = DB::table('user_interested_tag');

        foreach ($this->event->request->tags as $tag) {
            if (!$this->checkItExists($tag->id,'','user_interested_tag','tag_id',$token->id)) {
                $db = $table->insert([
                    'tag_id' => $tag->id,
                    'token_id' => $token->id,
                    'created_at' => Date::now(),
                ]);
            }
        }
    }


}
