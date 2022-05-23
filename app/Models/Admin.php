<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $table = 'admins';

    public $fillable = [
        'email','password'
    ];
    public $primaryKey = 'id';
    protected $hidden = [
        'password',
//        'remember_token',
    ];
//    protected $casts = [
//        'email_verified_at' => 'datetime',
//    ];



   // public $timestamps = true;
}
