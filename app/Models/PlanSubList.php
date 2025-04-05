<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanSubList extends Model
{
    use HasFactory;
    protected $fillable = [
        'sub_date',
        'sub_remark',
        'plan_type',
        'plan_sub',
        'person_at',
        'flag',
        'plan_id'
    ];
}
