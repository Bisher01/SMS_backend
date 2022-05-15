<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mockery\Matcher\Subset;

class Teacher_Subject extends Model
{
    use HasFactory;
    public $primaryKey = 'id';

    public $fillable = [
        'subject_id', 'teacher_id'
    ];

    public $timestamps = true;

    public function teacher(){
        return $this->belongsTo(Teacher::class, 'teacher_id');

    }
    public function subject(){
        return $this->belongsTo(Subject::class, 'subject_id');

    }
}
