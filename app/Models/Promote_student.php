<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promote_student extends Model
{
    use HasFactory;
    protected $table = 'promote_students';
    protected $primaryKey = 'id';
    protected $fillable = [
        'student_id',
        'from_academic_year_id',
        'to_academic_year_id',
        'from_grade_id',
        'to_grade_id',
        'from_class_id',
        'to_class_id',
        'from_classroom_id',
        'to_classroom_id',
        'promote_date',
    ];

}
