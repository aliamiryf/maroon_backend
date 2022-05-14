<?php

namespace App\traits;

use Illuminate\Support\Facades\Validator;

trait validatorData
{
    public function validatorData($data,$rules,$message=[]){
        $dataValidator = Validator::make($data,$rules,$message);
        if ($dataValidator->fails()){
            return [
                'status'=>false,
                'message'=>$dataValidator->getMessageBag()
            ];
        }else{
            return [
                'status'=>true,
                'data'=>$dataValidator->validated(),
            ];
        }
    }
}
