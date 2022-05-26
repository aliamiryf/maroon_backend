<?php

namespace App\Listeners;

use Illuminate\Support\Facades\DB;

class baseUserInterestedMethods
{
    public function checkItExists($item, $userID, $table, $column , $tokenID = null) : bool
    {
        $table = DB::table($table);

        $test = $table
            ->select()
            ->where($column, $item)
            ->where($tokenID == null ?  'user_id' : 'token_id',$tokenID == null ? $userID : $tokenID )
            ->get();
        if (count($test) == 0) {
            return false;
        }
        return true;
    }
}
