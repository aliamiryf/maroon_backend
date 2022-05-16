<?php

namespace App\Services\v1\main;

use App\Services\BaseServices;

class authServices extends BaseServices
{
    public function register($request)
    {
        $data = $this->validatorData($request->all(),[
            'username'=>'required|unique:users'
        ]);
        return $data;
    }
}
