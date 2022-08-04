<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class TimeTable extends Model
{
    use HasFactory;
    protected $table = 'time_tables';
    protected $primaryKey = 'id';

    protected $fillable  = [
        'lessonDay_id',
        'teacher_id',
        'classClassroom_id'
    ];
    public $timestamps = true;

    public function teacher(){
        return $this->hasMany(Teacher::class,'lessonDay_id','time_table_id');
    }
    public function lesson(){
        return $this->hasMany(LessonDay::class,'time_table_id');

    }   public function classroom(){
    return $this->hasMany(ClassClassroom::class,'time_table_id');
}

}
