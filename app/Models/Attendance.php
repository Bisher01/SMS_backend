<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    public $primaryKey = 'id';

    public $fillable = [
        'student_id','attendence-date','attendance-status'
    ];

    public $timestamps = true;

    public function student(){
        return $this->belongsTo(Student::class, 'student_id');

    }

}
