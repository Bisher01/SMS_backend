<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherClass extends Model
{
    use HasFactory;

    protected $table = 'teacher_classes';
    protected $primaryKey = 'id';
    protected $hidden = ['pivot'];
    protected $fillable = ['teacher_id', 'class_id'];

}
