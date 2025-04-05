<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalMedicineList extends Model
{
    use HasFactory;
    protected $fillable = [
    'medicine_date',
    'medicine_name',
    'medicine_age',
    'medicine_type',
    'medicine_remark',
    'medicine_result',
    'medicine_nameqty',
    'medicine_qty',
    'medicine_group',
    'created_at',
    'updated_at',
    ];
    
}
