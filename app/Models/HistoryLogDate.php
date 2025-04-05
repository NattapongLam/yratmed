<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryLogDate extends Model
{
    use HasFactory;
    protected $fillable = [
        'remark',
        'flag',
        'history_id',
        'created_at'
    ];
}
