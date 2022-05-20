<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporaryToken extends Model
{
    use HasFactory;
    protected $table = 'temporary_token';
    protected  $guarded = [];
}
