<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthenticationRequest extends Model
{
    protected $fillable = [
        'user_id',
        'approval',
        'approval_secret',
        'time',
        'remark',
        'browser',
        'is_confirm',
    ];

    protected $appends = [];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
