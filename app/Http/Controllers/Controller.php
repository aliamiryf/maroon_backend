<?php

namespace App\Http\Controllers;

use App\traits\responseToJson;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Schema;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests , responseToJson;

    public function PrepareDataByUrlParam($query,$param,$table)
    {
        $tablesFiled = Schema::getColumnListing('article');
        foreach ($tablesFiled as $filed){
            if (isset($param[$filed])){
                $query = $query->where($filed,$param[$filed]);
            }
        }
        if (isset($param['pagination'])){
            $query =  $query->paginate($param['pagination']);
        }else{
            $query = $query->get();
        }
        return $query;
    }
}
