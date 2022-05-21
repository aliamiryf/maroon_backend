<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class category extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'category';
    protected $guarded = [];
    public function articles(){
        return $this->hasMany(Article::class,'category_id');
    }

    public function articleCount(){
        return $this->hasMany(Article::class,'category_id')->where('status','publish');
    }

    public function userInterestedCategories()
    {
        return $this->belongsToMany(User::class,'category_interested_user','category_id','user_id')->withTimestamps()->distinct();
    }
}
