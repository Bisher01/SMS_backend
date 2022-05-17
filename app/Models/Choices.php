<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Choices extends Model
{
    use HasFactory;
    public $primaryKey = 'id';

    public $fillable = [
        'question_id','text','status'
    ];
    public $timestamps = true;
    public function question(){
        return $this->belongsTo(Question::class, 'question_id');
    }
}