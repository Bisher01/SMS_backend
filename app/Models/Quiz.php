<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $table = 'quizzes';

    protected $primaryKey = 'id';

    protected $fillable = [
        'mark' ,
        'quiz_name_id',
        'teacher_subject_id',
        'season_id'
        ];
    protected $hidden = ['pivot'];

    public function questions() {
        return $this->belongsToMany(
            Question::class,
            'question_quizzes',
            'quiz_id',
            'question_id'
        );
    }

    public function quizName() {
        return $this->belongsTo(Q::class);
    }
}
