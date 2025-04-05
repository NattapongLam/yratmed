<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalSubList extends Model
{
    use HasFactory;
    protected $fillable = [
        'sub_name',
        'flag',
    ];
}
