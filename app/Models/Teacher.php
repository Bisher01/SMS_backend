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
        'subject_id',
        'address_id',
        'blood_id',
        'grade_id',
        'gender_id',
        'f_name',
        'l_name',
        'email',
        'code',
        'joining_date',
        'salary'
    ];

    public $timestamps = true;

    public function teacher_subject(){
        return $this->hasMany(Teacher_Subject::class, 'teacher_id');

    }
   public function address(){
        return $this->hasOne(Address::class, 'address_id');
    }
    public function blood(){
        return $this->hasOne(Blood::class, 'blood_id');
    }
    public function grade(){
        return $this->belongsTo(Grade::class, 'grade_id');

    }
    public function gender(){
        return $this->hasOne(Blood::class, 'gender_id');
    }
}
