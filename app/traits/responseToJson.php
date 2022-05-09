<?php

namespace App\traits;

trait responseToJson
{
    public function responseJson($status = 'success',$message = "success",$data = [],$statusCode = 200){
        return response()->json([
            'staus'=>$status,
            'message'=>$message,
            'data'=>$data
        ],$statusCode);
    }
}
