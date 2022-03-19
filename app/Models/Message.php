<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'line_text',
        'sender_id',
        'receiver_id',
    ];


    function sender(){
        return $this->hasOne(User::class);
    }

    public function receiver(){
        return $this->hasOne(User::class, 'receiver_id');
    }

    public function user(){
        return $this->hasOne(User::class,'id');
    }
}
