<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassClassroom extends Model
{
    use HasFactory;

   // protected $table = 'claass_classrooms';
    protected $primaryKey = 'id';
    protected $fillable = [
        'class_id',
        'classroom_id'
    ];
    public $timestamps = true;

    public function teachers() {
        return $this->belongsToMany(Teacher::class, 'teacher_classclassroom','claass_classroom_id','teacher_id');

    }
}
