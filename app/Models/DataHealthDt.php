<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataHealthDt extends Model
{
    use HasFactory;
    protected $fillable = [
        'health_id',
        'sub_no',
        'sub_name',
        'sub_qty',
        'created_at',
        'updated_at'
    ];
}
