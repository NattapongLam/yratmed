<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataHealthHd extends Model
{
    use HasFactory;
    protected $fillable = [
        'remark',
        'total',
        'person_at',
        'flag',
        'created_at',
        'updated_at',
        'personal_id'
    ];
}
