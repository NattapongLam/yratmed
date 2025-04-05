<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalJointsList extends Model
{
    use HasFactory;
    protected $fillable = [
        'joint_name',
        'remark',
        'score',
        'flag',
        'personal_id',
    ];
}
