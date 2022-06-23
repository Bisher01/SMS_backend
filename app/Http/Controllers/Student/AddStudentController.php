<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddStudentRquest;
use App\Models\Paarent;
use App\Models\Student;
use App\Traits\generalTrait;
use Illuminate\Http\Request;

class AddStudentController extends Controller
{
    use generalTrait;
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddStudentRquest $request)
    {
        if ($request->hasFile('picture')) {
            $destination_path = 'public/images/students';
            $pathInData = 'storage/images/students';
            $image = $request->file('picture');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $path = $image->storeAs($destination_path, $image_name);
        }
        $parent = Paarent::query()
            ->where('national_number', $request->national_number)->first();
        if(!isset($parent))
        {
            $parent = Paarent::query()->create([
                'mother_name' => $request->mother_name,
                'father_name' => $request->father_name,
                'national_number' => $request->national_number,
                'code' => '002',
                'phone' => $request->parentPhone,
                'email' => $request->parentEmail,
                'jop' => $request->parentJop,
            ]);
            $parent->update([
                'code' => '002' . rand(0,9) .  $parent->id . rand(100, 999),
            ]);
            $data['parent'] = $parent;
        }
        $student = Student::query()->create([
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'email' => $request->email,
            'code' => '001',
            'nationality' => $request->nationality,
            'picture' => '/'.$pathInData.'/'.$image_name,
            'address_id' => $request->address_id,
            'birthdate' => $request->birthdate,
            'parent_id' => $parent->id,
            'blood_id' => $request->blood_id,
            'gender_id' => $request->gender_id,
            'religion_id' => $request->religion_id,
            'grade_id' => $request->grade_id,
            'class_id' => $request->class_id,
            'classroom_id' => $request->classroom_id,
            'academic_year_id' => $request->academic_year_id,
        ]);
        $student->update([
            'code' => '001' .$student->year_id.  rand(0, 99) . $student->id . rand(100, 999),
        ]);
        $data['student'] = $student;
        return $this->returnData('Student Data', $data,'signup successfully');
    }
}
