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

    protected $hidden = ['pivot'];




    public function teacherSubjects() {
        return $this->belongsToMany(
            TeacherSubject::class,
            'claass_classroom_teacher_subject',
            'c_cr_id',
            't_s_id'
        );
    }

}
