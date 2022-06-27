<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claass extends Model
{
    use HasFactory;
    protected $table = 'claasses';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'grade_id'
    ];
    public $timestamps = true;

    public function grade() {
        return $this->belongsTo(Grade::class, 'grade_id');
    }
    public function classExam(){
        return $this->hasMany(ClassExam::class, 'class_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(
            Subject::class,
            'subject_class',
            'class_id',
            'subject_id'
        );
    }
    public function teachers() {
        return $this->belongsToMany(
            Teacher::class,
            'subject_class',
            'class_id',
            'teacher_id'
        );
    }
    public function classroom() {
        return $this->belongsToMany(
            Classroom::class,
            'claass_classrooms',
            'class_id',
            'classroom_id'
        );
    }
}
