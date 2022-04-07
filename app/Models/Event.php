<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        //'description',
        'start',
        'end',
        'allDay',
        'color',
        'textColor',
        'assigned_to',
        'assigned_by',
    ];
}
