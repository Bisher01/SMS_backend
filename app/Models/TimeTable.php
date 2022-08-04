<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class TimeTable extends Model
{
    use HasFactory;

    protected $fillable  = [
        'lessonDay_id',
        'teacher_id',
        'classClassroom_id'
    ];
    public $timestamps = true;

}
