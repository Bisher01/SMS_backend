<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $table = 'promotions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'student_id',
        'from_academic_year_id',
        'to_academic_year_id',
        'from_class_id',
        'to_class_id',
    ];
    public function fromClass(){
        return $this->hasOne(Claass::class, 'from_class_id');
    }
    public function toclass(){
        return $this->hasOne(Claass::class, 'to_class_id');
    }
   public function student(){
        return $this->hasMany(Student::class, 'student_id');
    }
    public function fromAcademicYear(){
        return $this->hasOne(Academic_year::class, 'from_academic_year_id');
    }
    public function toAcademicYear(){
        return $this->hasOne(Academic_year::class, 'to_academic_year_id');
    }




}
