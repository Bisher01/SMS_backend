<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Student extends Authenticatable
{
    use HasApiTokens, HasFactory, SoftDeletes;
    protected $table = 'students';
    protected $primaryKey = 'id';
    protected $fillable = [
        'f_name',
        'l_name',
        'email',
        'code',
        'picture',
        'birthdate',
        'parent_id',
        'blood_id',
        'gender_id',
        'religion_id',
        'nationality_id',
        'grade_id',
        'class_id',
        'classroom_id',
        'academic_year_id',
        'address_id'
    ];

    protected $hidden = ['pivot','created_at','updated_at','deleted_at'
     ];


    public function grade(){
        return $this->belongsTo(Grade::class, 'grade_id');
    }
    public function claass(){
        return $this->belongsTo(Claass::class, 'class_id');
    }
    public function classroom(){
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }
    public function academic_year(){
        return $this->belongsTo(Academic_year::class, 'academic_year_id');
    }

    public function address(){
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function parent(){
        return $this->belongsTo(Paarent::class, 'parent_id');
    }

    public function blood(){
        return $this->belongsTo(Blood::class, 'blood_id');
    }

    public function religion(){
        return $this->belongsTo(Religtion::class, 'religion_id');
    }


    public function gender(){
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public function nationality(){
        return $this->belongsTo(Nationality::class, 'nationality_id');
    }

    public function attendance(){
        return $this->hasMany(Attendance::class, 'student_id');
    }
    public function fees_invoice(){
        return $this->hasMany(Fees_Invoices::class, 'student_id');

    }

    public function quizzes() {
        return $this->belongsToMany(
            Quiz::class,
            'quiz_marks',
            'student_id',
            'quiz_id');
    }


}
