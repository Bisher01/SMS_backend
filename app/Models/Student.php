<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    public function attendance(){
        return $this->hasMany(Attendance::class, 'student_id');
    }
    public function fees_invoice(){
        return $this->hasMany(Fees_Invoices::class, 'student_id');

    }
}
