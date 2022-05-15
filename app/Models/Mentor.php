<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    use HasFactory;
    public $primaryKey = 'id';

    public $fillable = [
        'email', 'f_name','l_name','code','address_id','joining_date','phone','class_id'
    ];

    public $timestamps = true;

    public function class(){
        return $this->hasOne(Claass::class, 'class_id');

    }
    public function address(){
        return $this->hasOne(Address::class, 'address_id');

    }
}
