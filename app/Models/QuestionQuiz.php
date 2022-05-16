<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionQuiz extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'name'
    ];

}
