<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    public $primaryKey = 'id';

    public $fillable = [
        'name'
    ];
    public $timestamps = true;

}
