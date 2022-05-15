<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_mark extends Model
{
    use HasFactory;
    protected $table = 'student_marks';
    protected $primaryKey = 'id';
    protected $fillable = [
        'mark',
        'student_id',
        'subject_id'
    ];

    public function students() {
        return $this->hasMany(Student::class, 'student_id');
    }
    public function subjects() {
        return $this->hasMany(Subject::class, 'subject_id');
    }
}
