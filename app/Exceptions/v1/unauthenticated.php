<?php

namespace App\Exceptions\v1;

use App\traits\responseToJson;
use Exception;

class unauthenticated extends Exception
{
    use responseToJson;
    public $message;
    public function __construct($message)
    {
        $this->message = $message;
    }

    public function render()
    {
        return $this->responseJson('401','unauthenticated',[
            'message'=>$this->message
        ],401);
    }
}
