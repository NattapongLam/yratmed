<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalDataList extends Model
{
    use HasFactory;
    protected $fillable = [
        'personal_name',
        'personal_sex',
        'personal_type',
        'personal_sub',
        'personal_birthday',
        'personal_age',
        'personal_underlying',
        'personal_currentmed',
        'personal_allergy',
        'personal_flag',
        'personal_tel',
        'personal_address',
        'serious_lllness',
        'serious_lnjury',
        'previous_surgery',
        'personal_img',
        'personal_email',
    ];
}
