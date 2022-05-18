<?php

namespace App\Services\v1\main;

use App\Exceptions\v1\invalidDateException;
use App\Exceptions\v1\unauthenticated;
use App\Models\v1\User;
use App\Services\BaseServices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class authServices extends BaseServices
{
    public $key;
    public function __construct()
    {
        $this->key=(string)rand(10,10);
    }

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
                $user = User::where($fieldUsername,$data['data']['user'])->first();
                return $this->responseJson('200','success',$this->generateToken($user->id),200);
            }else{
                throw new unauthenticated('نام کاربری یا رمز عبور اشتباه است');
            }
        }
        throw new invalidDateException($data['message']);
    }

    public function generateToken($userId)
    {
        $payload = [
            'userId'=>$userId
        ];
        $jwt = JWT::encode($payload, $this->key, 'HS256');
        return $jwt;
    }

    public function translateToken($token){
        $token = str_replace('Bearer ','',$token);
        $decoded = JWT::decode($token, new Key($this->key, 'HS256'));
        return $decoded->userId;
    }
    public function getProfile($token)
    {
        $userId = $this->translateToken($token);
        $user = User::find($userId);
        return $this->responseJson('200','success',\App\Http\Resources\v1\User::make($user),'200');
    }
}
