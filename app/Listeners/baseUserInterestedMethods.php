<?php

namespace App\Listeners;

use Illuminate\Support\Facades\DB;

class baseUserInterestedMethods
{
    public function checkItExists($item, $userID, $table, $column , $tokenID = null,$articleID) : bool
    {
        $table = DB::table($table);

        $test = $table
            ->select()
            ->where($column, $item)
            ->where($tokenID == null ?  'user_id' : 'token_id',$tokenID == null ? $userID : $tokenID )
            ->where('article_id',$articleID)
            ->get();
        if (count($test) == 0) {
            return false;
        }
        return true;
    }
}
