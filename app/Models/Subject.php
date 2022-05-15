<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    public $primaryKey = 'id';

    public $fillable = [
        'name', 'book_id'
    ];

    public $timestamps = true;

    public function book(){
        return $this->hasMany(Book::class, 'subject_id');

    }
    public function teacher(){
        return $this->hasMany(Teacher::class, 'subject_id');

    }
}
