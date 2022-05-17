<?php

namespace App\Services\v1\main;

use App\Exceptions\v1\invalidDateException;
use App\Models\v1\User;
use App\Services\BaseServices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class authServices extends BaseServices
{
    public function register($request)
    {

        $data = $this->validatorData($request->all(),[
            'username'=>'required|unique:users',
            'email'=>'required|unique:users|email',
            'password'=>'required|min:6',
        ]);
        if ($data['status']){
            $user = User::create([
                'username'=>$data['data']['username'],
                'email'=>$data['data']['email'],
                'password'=>Hash::make($data['data']['password']),
            ]);
            return $this->responseJson('200','success',\App\Http\Resources\v1\User::make($user),200);
        }
        return $data;

    }

    public function loginByUsernamePassword($request){
        $data = $this->validatorData($request->all(),[
            'password'=>'required',
            'user'=>'required',
        ]);
        if ($data['status']){
            $fieldUsername = filter_var($data['data']['user'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
            if (Auth::attempt([$fieldUsername=>$data['data']['user'],'password'=>$data['data']['password']])){
                return 'login';
            }else{
                return 'false';
            }
        }
        throw new invalidDateException($data['message']);

    }
}
