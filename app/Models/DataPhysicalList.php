<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPhysicalList extends Model
{
    use HasFactory;
    protected $fillable = [
        'personal_id',
        'person_at',
        'flag',
        'physical_date',
        'physical_diagnosis',
        'physical_treatment',
        'physical_results',
        'physical_remark',
        'created_at',
        'updated_at',
    ];
}
