<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claass extends Model
{
    use HasFactory;
    protected $table = 'classes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'grade_id'
    ];
    public $timestamps = true;

    public function grade() {
        return $this->belongsTo(Grade::class, 'grade_id');
    }
    public function class_exam(){
        return $this->hasMany(ClassExam::class, 'class_id');
    }
}
