<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user',
        'file_upload',
        'new_message',
        'new_schedule',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
