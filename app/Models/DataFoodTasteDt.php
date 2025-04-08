<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataFoodTasteDt extends Model
{
    use HasFactory;
    protected $fillable = [
        'foodtaste_id',
        'foodtaste_no',
        'foodtaste_name',
        'foodtaste_qty',
        'foodtaste_remark',
        'created_at',
        'updated_at',
    ];
}
