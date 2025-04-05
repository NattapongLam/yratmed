<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalLapHd extends Model
{
    use HasFactory;
    protected $fillable = [
        'lap_date',
        'lap_remark',
        'flag',
        'person_at',
        'created_at',
        'updated_at'
    ];
}
