<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    public $primaryKey = 'id';

    public $fillable = [
       'name','mark','subject_id'
    ];

    public $timestamps = true;

    public function classExam(){
        return $this->hasMany(ClassExam::class, 'exam_id');

    }
   public function subject(){
        return $this->belongsTo(Subject::class, 'subject_id');
    }
    public function questionExam(){
        return $this->hasMany(QuestionExam::class, 'exam_id');

    }
}
