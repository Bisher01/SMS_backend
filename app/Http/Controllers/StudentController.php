<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Paarent;
use Symfony\Component\Console\Input\Input;
use Illuminate\Http\Request;
use App\Traits\generalTrait;
use Illuminate\Support\Facades\Facade;
use phpDocumentor\Reflection\Types\Parent_;
use PhpParser\Builder\Param;
use PHPUnit\Framework\MockObject\Builder\Stub;

class StudentController extends Controller
{
    use generalTrait;

    public function index()
    {
        $students=Student::query()->get();
      //  $parents=Paarent::query()->get();

        $data['students'] = $students;
      //  $data['parents'] = $parents;

    return $this->returnData('Student&parent Data', $data,'success');
    }


   public function store(Request $request)
   {

          $parent=Paarent::query()->where('father_name',$request->father_name)->first();
            if(!isset($parent))
            {

                $parent=Paarent::query()->create([
                                'mother_name'=>$request->mother_name,
                                'father_name'=>$request->father_name,
                                'code'=>$request->code,
                                'nationality'=>$request->nationality,
                                'phone'=>$request->phone,
                                'email'=>$request->email,
                                'jop'=>$request->jop,
                                'religion_id'=>$request->religion_id,
                                'blood_id'=>$request->blood_id,

                            ]);
                          $data['parent'] = $parent;

            }

            $student = Student::query()->create([
         // 'picture'=> $imagepath,
          'f_name'=>$request->f_name,
          'l_name'=>$request->l_name,
          'email'=>$request->email,
          'code'=>$request->code,
          'nationality'=>$request->nationality,
          'address_id'=>$request->address_id,
          'birthdate'=>$request->birthdate,
          'parent_id'=>$parent->id,
          'blood_id'=>$request->blood_id,
          'gender_id'=>$request->gender_id,
          'religion_id'=>$request->religion_id,
          'grade_id'=>$request->grade_id,
          'class_id'=>$request->class_id,
          'classroom_id'=>$request->classroom_id,
          'academic_year_id'=>$request->academic_year_id,

      ]);
        $data['student'] = $student;
      return $this->returnData('Student Data', $data,'signup successfully');

    }





    public function show(Student $student)
    {
        $data['student'] = $student;
        return $this->returnData('Student&parent Data', $data,'success');

    }


    public function update(Request $request, Student $student)
    {
        if($request->file('file')){
      $result = $request->file('picture')->store($request->f_name);
    $student->update(['picture'=>$result]);
    }
        $student->update([

        'f_name'=>$request->f_name,
        'l_name'=>$request->l_name,
        'email'=>$request->email,
        'code'=>$request->code,
        'nationality'=>$request->nationality,
        'address_id'=>$request->address_id,
        'birthdate'=>$request->birthdate,
        'parent_id'=>$request->parent_id,
        'blood_id'=>$request->blood_id,
        'gender_id'=>$request->gender_id,
        'religion_id'=>$request->religion_id,
        'grade_id'=>$request->grade_id,
        'class_id'=>$request->class_id,
        'classroom_id'=>$request->classroom_id,
        'academic_year_id'=>$request->academic_year_id,
        ]);

        $data['student'] = $student;
        return $this->returnData('Student Data', $data,'update successfully');
    }


    public function destroy(Student $student)
    {
        $student->delete();
    }
}
