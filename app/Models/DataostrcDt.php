<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataostrcDt extends Model
{
    use HasFactory;
    protected $fillable = [
        'dataostrc_id',
        'sub_name',
        'sub_qty',
        'sub_remark',
        'sub_no',
    ];
}
