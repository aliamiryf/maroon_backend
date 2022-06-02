<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SegmentCondition extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'segment_conditions';
    static $rules = [
        'count',
        'article_id',
        'tag_id',
        'category_id',
        'table',
        'useHistory'
    ];

    protected function condition(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_decode($value),
        );
    }
}
