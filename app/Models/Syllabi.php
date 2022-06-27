<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Syllabi extends Model
{
    use HasFactory;

    protected $table = 'syllabi';
    protected $fillable  = [
        'content' ,
        'subject_class_id',
    ];
    public $timestamps = true;
    protected $primaryKey = 'id';

    public function sub_class() {
        return $this->belongsTo(SubjectClass::class, 'subject_class_id');
    }
}
