<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $table = 'teachers';

    public $primaryKey = 'id';
    public $fillable = [
        'address_id',
        'religion_id',
        'grade_id',
        'gender_id',
        'f_name',
        'l_name',
        'email',
        'code',
        'joining_date',
        'salary',
        'picture'
    ];

    public $timestamps = true;
   // protected $hidden = ['code'];
    public function subject(){
        return $this->belongsToMany(Subject::class, 'teacher__subjects','teacher_id','subject_id');

    }
   public function address(){
        return $this->hasOne(Address::class, 'address_id');
    }
    public function religion(){
        return $this->hasOne(Blood::class, 'religion_id');
    }
    public function grade(){
        return $this->belongsTo(Grade::class, 'grade_id');

    }
    public function gender(){
        return $this->hasOne(Blood::class, 'gender_id');
    }

    public function subjects() {
        return $this->belongsToMany(Subject::class, 'subject_class','teacher_id','subject_id');
    }
    public function classes() {
        return $this->belongsToMany(Claass::class, 'subject_class','teacher_id','class_id');

    }
    public function classClassroom() {
        return $this->belongsToMany(ClassClassroom::class, 'teacher_classclassroom','teacher_id','claass_classroom_id');

    }
}
