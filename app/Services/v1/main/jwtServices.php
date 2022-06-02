<?php

namespace App\Services\v1\main;

use App\Models\v1\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class jwtServices
{
    public $key;
    public function __construct()
    {
        $this->key=(string)rand(10,10);

    }

    public function generateToken($body)
    {
        $jwt = JWT::encode($body, $this->key, 'HS256');
        return $jwt;
    }

    public function translateToken($token)
    {
        $token = str_replace('Bearer ','',$token);
        $decoded = JWT::decode($token, new Key($this->key, 'HS256'));
        return $decoded;
    }

    public function translateTokenAndFindUser($token){
        $userInfo = $this->translateToken($token);
        return User::find($userInfo->userId);
    }
}
