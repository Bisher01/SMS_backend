<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectMark extends Model
{
    use HasFactory;


    public $primaryKey = 'id';

    public $fillable = [
        'subject_id', 'class_id','min','max'
    ];

    public $timestamps = true;

    public function subject(){
        return $this->belongsTo(Subject::class, 'subject_id');

    }
   /* public function class(){
        return $this->belongsTo(Class::class, 'class_id');
    }*/

}
