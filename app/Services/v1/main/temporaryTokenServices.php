<?php

namespace App\Services\v1\main;

use App\Models\v1\TemporaryToken;
use App\Services\BaseServices;

class temporaryTokenServices extends BaseServices
{
    public $jwtServices;
    public function __construct(jwtServices $jwtServices)
    {
        $this->jwtServices = $jwtServices;
    }

    public function generateToken()
    {
        $body = [
            'type'=>'temporaryToken',
            'key'=>rand(10000,1000)
        ];
        $token = $this->jwtServices->generateToken($body);
        $tokenExists = TemporaryToken::where('token',$token)->exists();
         while($tokenExists){
             $token = $this->jwtServices->generateToken($body);
             $tokenExists = TemporaryToken::where('token',$token)->exists();
         }
         TemporaryToken::create([
             'token'=>$token,
         ]);
         return $this->responseJson('200','success',['token'=>$token],200);
    }
}
