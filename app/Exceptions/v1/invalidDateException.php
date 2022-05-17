<?php

namespace App\Exceptions\v1;

use App\traits\responseToJson;
use Exception;


class invalidDateException extends Exception
{
    public $errore;
    use responseToJson;
    public function __construct($errore)
    {
        $this->errore = $errore;
    }
    public function render(){
      return  $this->responseJson('400','invalid data',$this->errore,422);
    }
}
