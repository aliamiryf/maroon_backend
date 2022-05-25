<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory , SoftDeletes;
    protected $table = 'tag';
    protected $guarded = [];
    public function parentCategory()
    {
        return $this->belongsTo(category::class,'category_id');
    }
}
