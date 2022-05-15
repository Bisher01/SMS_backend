<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fees extends Model
{
    use HasFactory;
    public $primaryKey = 'id';

    public $fillable = [
        'amount', 'grade_id','accademic_year_id'
    ];

    public $timestamps = true;

    public function grade(){
        return $this->hasOne(Grade::class, 'grade_id');

    }
    public function accademic_year(){
        return $this->hasOne(Address::class, 'accademic_year_id');

    }
    public function fees_invoice(){
        return $this->hasMany(Fees_Invoices::class, 'fee_id');

    }
}
