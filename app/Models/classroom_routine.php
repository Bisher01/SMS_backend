<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class classroom_routine extends Model
{
    use HasFactory;
    protected $table = 'classroom_routines';
    protected $primaryKey = 'id';
    protected $fillable = [
        'start_oclock',
        'end_oclock',
        'day_id',
        'teacher_id',
        'classroom_id',
        'class_id',
    ];

    public function day() {
        return $this->belongsTo(Week_days::class, 'day_id');
    }

}
