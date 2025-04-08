<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataFoodTasteHd extends Model
{
    use HasFactory;
    protected $fillable = [
        'personal_id',
        'dietarycheck1',
        'dietaryremark1',
        'dietarycheck2',
        'dietaryremark2',
        'dietarycheck3',
        'dietaryremark3',
        'remark',
        'person_at',
        'flag',
        'created_at',
        'updated_at',
        'foodtaste_date',
        'foodtaste_type'
    ];
}
