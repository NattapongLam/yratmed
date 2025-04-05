<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalLapList extends Model
{
    use HasFactory;
    protected $fillable = [
        'personal_name',
        'personal_age',
        'bh',
        'bw',
        'bmi',
        'rbc',
        'hb',
        'hct',
        'mvc',
        'mch',
        'mchc',
        'rdw',
        'wbc',
        'plt',
        'ferritin',
        'cpk',
        'bloodsugar',
        'bun',
        'cr',
        'gf',
        'ast',
        'alt',
        'alp',
        'albumin',
        'sp',
        'ph',
        'prot',
        'glucose',
        'ketone',
        'wb',
        'rb',
        'epith',
        'bac',
        'mucous',
        'flag',
        'person_at',
        'personal_id',
        'remark',
        'created_at',
        'updated_at',
        'lap_id',       
    ];
}
