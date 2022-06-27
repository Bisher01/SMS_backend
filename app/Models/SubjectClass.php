<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectClass extends Model
{
    use HasFactory;

    protected $table='subject_class';

    protected $primarykey ='id';

    protected $fillable=[

        'class_id','subject_id'
    ];

    public $timetamps = true;

    public function syllabi()
    {
        return $this->hasMany(Syllabi::class ,'subject_class_id');
    }

}
