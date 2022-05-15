<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fees_Invoices extends Model
{
    use HasFactory;
    public $primaryKey = 'id';

    public $fillable = [
        'date', 'student_id','fee_id','amount'
    ];

    public $timestamps = true;

    public function fee(){
        return $this->belongsTo(Fees::class, 'fee_id');

    }
    public function student(){
        return $this->belongsTo(Grade::class, 'student_id');

    }
}
