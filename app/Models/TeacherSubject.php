<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherSubject extends Model
{
    use HasFactory;

    protected $table = 'teacher__subjects';
    protected $primaryKey = 'id';
    protected $hidden = ['pivot', 'created_at', 'updated_at'];
    public function teachers() {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
