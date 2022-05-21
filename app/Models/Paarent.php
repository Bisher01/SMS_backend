<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Paarent extends Authenticatable
{
    use HasApiTokens, HasFactory;
    protected $table = 'parents';
    public $primaryKey = 'id';

    public $fillable = [
       'blood_id','religion_id','mother_name','father_name','code','nationality','email','jop','phone'
    ];

    public $timestamps = true;

    public function blood(){
        return $this->hasOne(Blood::class, 'blood_id');

    }
   public function religion(){
        return $this->hasOne(Religtion::class, 'religion_id');
    }
}
