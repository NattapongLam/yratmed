<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataJointSub extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'no'
    ];
}
