<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Segment extends Model
{
    use HasFactory;

    protected $table = 'segment';

    public function conditions(){
        return $this->hasMany(SegmentCondition::class,'segment_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'segment_user','segment_id','user_id');
    }


}
