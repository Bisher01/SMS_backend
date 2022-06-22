<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddStudentRquest;
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
        $student = Student::query()->create([
                'l_name'           =>  $request->lastName,
                'f_name'           =>  $request->firstName,
                'email'            =>  $request->email,
                'code'             =>  '01',
                'nationality'      =>  $request->nationality,
                'picture'          =>  $request->picture,
                'birthdate'        =>  $request->birthDate,
                'parent_id'        =>  $request->parent_id,
                'blood_id'         =>  $request->blood_id,
                'gender_id'        =>  $request->gender_id,
                'religion_id'      =>  $request->religion_id,
                'grade_id'         =>  $request->grade_id,
                'class_id'         =>  $request->class_id,
                'classroom_id'     =>  $request->classroom_id,
                'academic_year_id' =>  $request->academic_year_id,
                'address_id'       =>  $request->address_id,
        ]);
        $student->update([
            'code' =>
                '01' .$student->grade_id . $student->class_id . rand(100, 999) . $student->id .rand(1, 9)
        ]);
        return $this->returnData('data', $student, "added student success");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
