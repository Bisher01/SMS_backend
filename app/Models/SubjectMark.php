<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectMark extends Model
{
    use HasFactory;


    public $primaryKey = 'id';

    public $fillable = [
        'subject_id', 'class_id','mark'
    ];

    public $timestamps = true;

   

}
