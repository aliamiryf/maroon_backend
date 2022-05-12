<?php

namespace App\traits;

trait PreparePaginationData
{
    public function PreparePaginationData($query,$paginate)
    {
        return $query->paginate(10);
        if (array_key_exists('pagination',$paginate)){
            $query =  $query->paginate($paginate['pagination']);
        }else{
            $query = $query->paginate(10);
        }
        return $query;
    }
}
