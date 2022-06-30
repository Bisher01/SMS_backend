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
        'quiz_name_id',
        'C_Cr_T_S_id'
        ];
}
