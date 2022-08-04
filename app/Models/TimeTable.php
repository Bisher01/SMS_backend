<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class TimeTable extends Model
{
    use HasFactory;

    protected $fillable  = [
        'lessonDay_id',
        'teacher_id',
        'classClassroom_id'
    ];
    public $timestamps = true;

    public function teacher(){
        return $this->hasMany(Teacher::class,'time_table_id');
    }
    public function lesson(){
        return $this->hasMany(Le::class,'time_table_id');
    }   public function teacher(){
    return $this->hasMany(Teacher::class,'time_table_id');
}

}
