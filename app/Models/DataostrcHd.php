<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataostrcHd extends Model
{
    use HasFactory;
    protected $fillable = [
    'remark',
    'person_at',
    'flag',
    'created_at',
    'updated_at',
    'score1',
    'score2',
    'score3',
    'score4',
    'score5',
    'score6',
    'score7'
    ];
}
