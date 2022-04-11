<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Laravel\Sanctum\HasApiTokens;

class Message extends Model
{
    use HasFactory, HasApiTokens, HasFactory;

    protected $fillable = [
        'line_text',
        'sender_id',
        'receiver_id',
    ];


    function sender(){
        return $this->hasOne(User::class, 'id','sender_id');
    }

    public function receiver(){
        return $this->hasOne(User::class, 'receiver_id');
    }

    public function user(){
        return $this->hasOne(User::class,'id');
    }
}
