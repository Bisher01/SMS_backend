<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $table = 'questions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'text',
        'question_type_id',
    ];

    protected $hidden = ['pivot'];

    public function questionType(){
        return $this->belongsTo(QuestionType::class, 'question_type_id');
    }

    public function choices(){
        return $this->hasMany(Choice::class, 'question_id');
    }

    public function questionExam(){
        return $this->hasMany(QuestionExam::class, 'question_id');
    }
}
