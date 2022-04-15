<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'scheduleType',
        'title',
        'description',
        'start',
        'end',
        'color',
        'textColor',
        'assigned_to',
        'assigned_by',
        'is_completed',
        'request_time_off_id',
        'confirm_time_off_id',
        'is_group',
    ];
}
