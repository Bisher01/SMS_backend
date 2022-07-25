<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddStudentRquest;
use App\Models\Paarent;
use App\Models\Student;
use App\Traits\basicFunctionsTrait;
use App\Traits\generalTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
class AddStudentController extends Controller
{
    use generalTrait, basicFunctionsTrait;



    public function index()
    {
        $students=Student::query()
            ->with('grade')
            ->with('claass')
            ->with('classroom')
            ->with('academic_year')
            ->with('address')
            ->with('parent')
            ->with('blood')
            ->with('religion')
            ->with('gender')
            ->with('nationality')->get();
        return $this->returnAllData('student', $students,'success');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddStudentRquest $request)
    {

        $parent = Paarent::query()
            ->where('national_number', $request->national_number)->first();
        if (!isset($parent)) {
            if($request->mother_name == null || $request->father_name == null ) {
                return $this->returnErrorMessage('teacher not found', 404);
            }
            else {
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
            }
        }
        $data['parent'] = $parent;

        $time = Carbon::now();

        if ($request->hasFile('picture')) {

            $picture = '/'.$request->file('picture')
                    ->store($time->format('Y').'/images/student/'. $request->f_name. '_'. $request->l_name);
        }
        else{
            $picture = null;
        }

        $address = $this->addAddress($request);

        $student = Student::query()->create([
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'email' => $request->email,
            'code' => '001',
            'nationality_id' => $request->nationality_id,
            'picture' => $picture,
            'address_id' =>$address->id,
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
        return $this->returnData('student', $data,'signup successfully');
    }


    public function show(Student $student)
    {
        $student_info = $student->load('grade')
            ->load('claass')
            ->load('classroom')
            ->load('academic_year')
            ->load('address')
            ->load('parent')
            ->load('blood')
            ->load('religion')
            ->load('gender')
            ->load('nationality');
        return $this->returnData('student',$student_info,'success');
    }

    public function update(Request $request, Student $student)
    {
        $time = Carbon::now();
        if ($request->hasFile('picture')) {
            if (Storage::exists($student->picture)) {
                Storage::delete($student->picture);
                Storage::deleteDirectory($time->format('Y').'/images/student/'. $student->f_name. '_'. $student->l_name);
            }
            $picture =  '/'.$request->file('picture')
                    ->store($time->format('Y').'/images/student/'. $request->f_name. '_'. $request->l_name);
            $student->update(['picture' => $picture]);
        }

        $address = $this->addAddress($request);

        $student->update([
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'email' => $request->email,
            'nationality_id' => $request->nationality_id,
            'address_id' =>  $address->id,
            'birthdate' => $request->birthdate,
            'parent_id' => $request->parent_id,
            'blood_id' => $request->blood_id,
            'gender_id' => $request->gender_id,
            'religion_id' => $request->religion_id,
            'grade_id' => $request->grade_id,
            'class_id' => $request->class_id,
            'classroom_id' => $request->classroom_id,
            'academic_year_id' => $request->academic_year_id,
        ]);

        return $this->returnData('student', $student,'update successfully');
    }


    public function destroy(Student $student)
    {
        $student->delete();
        return $this->returnSuccessMessage('deleted successfully');
    }
}


