<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class TimeTable extends Model
{
    use HasFactory;

    protected $fillable  = [
        'check' ,
        'grade_id',
        'lesson_day_id',
        'teacher_info_id'
    ];
    public $timestamps = true;

    public function grade(){
        return $this->hasMany(Grade::class, 'time_table_id');
    }

    public function lesson_day(){
        return $this->hasMany(DB::table('lesson_day'), 'time_table_id');
    }
     public function teacher_info(){
        return $this->hasMany(DB::table('claass_classroom_teacher_subject'), 'time_table_id');
    }




}
