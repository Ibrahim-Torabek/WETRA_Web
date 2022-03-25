<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_name',
        'event_description',
        'event_start_date',
        'event_end_date',
        'is_all_day',
        'color',
        'text_color',
        'assigned_to',
        'assigned_by',
    ];
}
