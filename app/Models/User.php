<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

//use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',

        'group_id',
        'image_url',
        'job_title',
        'phone_number',
        'address',
        'registered_date',
        'status',
        'is_admin',

        'emergency_name',
        'emergency_phone',

        // 'updated_at',
        // 'created_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function sentMessages(){
        return $this->hasMany(Message::class,'sender_id');
    }
    
    function receivedMessages(){
        return $this->hasMany(Message::class,'receiver_id');
    }

    function isAdmin(){
        if ($this->is_admin == 1)
            return "Yes";

        return "No";
    }

    function group(){
        return $this->hasOne(Group::class, 'id','group_id');
    }

    function settings(){
        return $this->hasOne(Setting::class); // link setting table's user to user table's id
    }

    function status(){
        if($this->status == 0)
            return "In Active";

        return "Active";
    }

    // function allMessages(){
    //     $received = $this->hasMany(Message::class,'receiver_id');
    //     $sent = $this->hasMany(Message::class,'sender_id');

    //     $all = $received->merge($sent);
    //     return $all.sortBy('created_at');
    // }
}
