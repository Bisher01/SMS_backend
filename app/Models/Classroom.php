<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;
    protected $table = 'classrooms';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'max_number',
    ];
    public $timestamps = true;

   
}
