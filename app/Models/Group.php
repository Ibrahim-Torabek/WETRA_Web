<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
    ];

    function user(){
        return $this->belongsTo(Group::class);
    }
    function users(){
        return $this->hasMany(User::class);
    }
}
