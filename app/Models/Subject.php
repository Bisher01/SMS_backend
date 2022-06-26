<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    public $primaryKey = 'id';

    public $fillable = [
        'name',
    ];

    public $timestamps = true;

    public function book(){
        return $this->hasMany(Book::class, 'subject_id');

    }
    public function teacher_subject(){
        return $this->hasMany(Teacher_Subject::class, 'subject_id');

    }
    public function exam(){
        return $this->hasMany(Exam::class, 'subject_id');

    }

    public function classes() {
        return $this->belongsToMany(Claass::class, 'subject_class');
    }
    public function teachers() {
        return $this->belongsToMany(Teacher::class, 'subject_class');
    }
}
