<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    public $table = 'admins';

    public $primaryKey = 'id';

    public $fillable = [
        'email','password'
    ];

    public $timestamps = true;
}
