<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'text',
        'question_type_id',

    ];
    public function question_type(){
        return $this->belongsTo(QuestionType::class, 'question_type_id');
    }
    public function choices(){
        return $this->hasMany(Choices::class, 'question_id');
    }
    public function question_exam(){
        return $this->hasMany(QuestionExam::class, 'question_id');
    }
}
