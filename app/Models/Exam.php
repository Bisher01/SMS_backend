<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    public $primaryKey = 'id';

    public $fillable = [
       'mark','subject_id','exam_name_id','class_id'
    ];

    public $timestamps = true;

    public function classExam(){
        return $this->hasMany(ClassExam::class, 'exam_id');

    }

    public function class(){
        return $this->belongsTo(Claass::class, 'class_id');

    }

    public function name(){
        return $this->belongsTo(ExamName::class, 'exam_name_id');

    }
   public function subject(){
        return $this->belongsTo(Subject::class, 'subject_id');
    }
    public function questionExam(){
        return $this->hasMany(QuestionExam::class, 'exam_id');

    }
}
