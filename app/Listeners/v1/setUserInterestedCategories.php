<?php

namespace App\Listeners\v1;

use App\Events\userReadArticle;
use App\Listeners\baseUserInterestedMethods;
use App\Models\v1\TemporaryToken;
use App\Models\v1\User;
use App\Services\v1\main\jwtServices;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class setUserInterestedCategories extends baseUserInterestedMethods
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
     * @param \App\Events\userReadArticle $event
     * @return void
     */
    public function handle()
    {
        if ($this->event->request->header('authorization') != null) {
            $this->setCategoryLoginUser();

        } else if ($this->event->request->header('user_temporary_token') != null) {

            $this->setCategoryGuestUser();
        }
    }

    public function setCategoryLoginUser()
    {

        $token = str_replace('Bearer ', '', (string)$this->event->request->header('authorization'));


        $user = $this->jwtServices->translateToken($token);

        if (!$this->checkItExists($this->event->request->category->id,$user->userId,'category_interested_user','category_id')) {

            User::find($user->userId)->userInterestedCategories()->attach([$this->event->request->category->id]);

        }
    }

    public function setCategoryGuestUser()
    {
        $token = TemporaryToken::where('token', $this->event->request->header('user_temporary_token'))->first();


        if (!$this->checkItExists($this->event->request->category->id,'','category_interested_user','category_id',$token->id)) {
            $db = DB::table('category_interested_user')->insert([
                'category_id' => $this->event->request->category->id,
                'token_id' => $token->id,
                'created_at' => Date::now(),
            ]);
        }
    }
}
