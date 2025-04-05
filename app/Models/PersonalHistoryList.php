<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalHistoryList extends Model
{
    use HasFactory;
    protected $fillable = [
        'serious_lllness',
        'serious_lnjury',
        'previous_surgery',
        'flag',
        'created_at',
        'updated_at',
        'person_at',
        'personal_id',
        'history_date',
        'status_id',
        'temperature',
        'pulse',
        'breathe',
        'pressure',
        'mercury',
        'pain',
        'diagnosis',
        'treatment',
        'nature',
        'severity',
    ];
}
