<?php

namespace App\Exceptions\v1;

use App\traits\responseToJson;
use Exception;

class platformException extends Exception
{
    use responseToJson;
    public $host;
    public $responceJson;
    public function __construct($host)
    {
        $this->host = $host;
    }

    public function render($request){
        return 'sdfsf';
        return $this->responseJson('Failed','Failed',['message'=>'پلتفرم شما در سیستم ثبت نشده است '],'400');
    }
}
