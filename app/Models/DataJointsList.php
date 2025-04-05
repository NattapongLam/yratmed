<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataJointsList extends Model
{
    use HasFactory;
    protected $fillable = [
        'joint_name',
        'flag',
    ];
}
