<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SegmentCondition extends Model
{
    use HasFactory;

    protected $table = 'segment_conditions';
    //    public $rules = [
//        'count' => 2,
//        'article_id' => 1,
//        'tag_id' => 1,
//        'category_id' => 1,
//        'table'=>'1',
//        'useHistory'=>1,
//    ];
//    public $f = [
//        'count'=>'2',
//        'category_id'=>1,
//        'table'=>'category_interested_user'
//    ];
    protected function condition() : Attribute
    {
        return Attribute::make(
            get : fn($value) => json_decode($value),
        );
    }
}
