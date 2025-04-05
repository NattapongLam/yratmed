<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanDataList extends Model
{
    use HasFactory;
    protected $fillable = [
        'plan_date',
        'plan_remark',
        'person_at',
        'flag',
    ];
}
