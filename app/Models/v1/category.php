<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $table = 'category';


    public function articles(){
        return $this->hasMany(Article::class,'category_id');
    }

    public function articleCount(){
        return $this->hasMany(Article::class,'category_id')->where('status','publish');
    }
}
