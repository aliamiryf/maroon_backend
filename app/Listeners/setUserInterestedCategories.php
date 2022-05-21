<?php

namespace App\Listeners;

use App\Events\userReadArticle;
use App\Models\v1\TemporaryToken;
use App\Models\v1\User;
use App\Services\v1\main\jwtServices;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class setUserInterestedCategories
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public $event;
    public $jwtServices;
    public function __construct(userReadArticle $event,jwtServices $jwtServices)
    {
        $this->jwtServices = $jwtServices;
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
        if($this->event->request->header('authorization') != null){

            $this->setCategoryLoginUser();

        }else if ($this->event->request->header('user_temporary_token') != null){


            $this->setCategoryGuestUser();
        }
    }

    public function setCategoryLoginUser()
    {
        $token = str_replace('Bearer ','',(string) $this->event->request->header('authorization'));

        $user = $this->jwtServices->translateToken($token);

        User::find($user->userId)->userInterestedCategories()->sync([$this->event->request->category->id]);
    }

    public function setCategoryGuestUser(){
        $token = TemporaryToken::where('token',$this->event->request->header('user_temporary_token'))->first();

        $test = DB::table('category_interested_user')
            ->select()
            ->where('category_id',$this->event->request->category->id)
            ->where('token_id',$token->id)
            ->get();

        if (count($test) == 0 ){
            $db = DB::table('category_interested_user')->insert([
                'category_id'=>$this->event->request->category->id,
                'token_id'=>$token->id,
                'created_at'=>Date::now(),
            ]);
        }
    }
}
