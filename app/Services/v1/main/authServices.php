<?php

namespace App\Services\v1\main;

use App\Models\v1\User;
use App\Services\BaseServices;

class authServices extends BaseServices
{
    public function register($request)
    {
        $data = $this->validatorData($request->all(),[
            'username'=>'required|unique:users',
            'email'=>'required|unique:users|email',
            'password'=>'required|min:6'
        ]);
        $user = User::create([
            'username'=>$data['data']['username']
        ]);
        return $data;
    }
}
