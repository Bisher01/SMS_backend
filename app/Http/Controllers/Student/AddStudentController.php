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
        $students=Student::query()->get();
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
        $classClassroomId = $this->checkClassClassroom($request->class_id, $request->classroom_id);
        if (!isset($classClassroomId)) {
            return $this->returnErrorMessage('input error', 400);
        }
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
//        $data['parent'] = $parent;

        $time = Carbon::now();

        $byte_array = $request->picture;
        $image = base64_decode($byte_array);
        Storage::put($time->format('Y').'/images/student/'. $request->f_name. '_'. $request->l_name. '/'. $request->l_name. '.jpg', $image);
        $picture = '/'. $time->format('Y').'/images/student/'. $request->f_name. '_'. $request->l_name. '/'. $request->l_name. '.jpg';

//        if ($request->hasFile('picture')) {
//
//            $picture = '/'.$request->file('picture')
//                    ->store($time->format('Y').'/images/student/'. $request->f_name. '_'. $request->l_name);
//        }
//        else{
//            $picture = null;
//        }

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
            'class_classroom_id' => $classClassroomId->id,
            'academic_year_id' => $request->academic_year_id,
        ]);
        $student->update([
            'code' => '001' .$student->year_id.  rand(0, 99) . $student->id . rand(100, 999),
        ]);

//        $data = $student
//            ->load('academic_year',
//                'grade',
//                'classClassroom',
//                'address',
//                'parent',
//                'blood',
//                'religion',
//                'gender',
//                'nationality');
        return $this->returnData('student', $student,'signup successfully');

    }


    public function show(Student $student)
    {
        return $this->returnData('student',$student,'success');
    }

    public function update(Request $request, Student $student)
    {
        $time = Carbon::now();
//        if ($request->hasFile('picture')) {
//        return $student->picture;

            if (Storage::exists($student->picture)) {
                Storage::delete($student->picture);
                Storage::deleteDirectory($time->format('Y').'/images/student/'. $student->f_name. '_'. $student->l_name);
            }
        $byte_array = $request->picture;
        $image = base64_decode($byte_array);
        Storage::put($time->format('Y').'/images/student/'. $request->f_name. '_'. $request->l_name. '/'. $request->l_name. '.jpg', $image);
        $picture = '/'. $time->format('Y').'/images/student/'. $request->f_name. '_'. $request->l_name. '/'. $request->l_name. '.jpg';
//            $picture =  '/'.$request->file('picture')
//                    ->store($time->format('Y').'/images/student/'. $request->f_name. '_'. $request->l_name);
            $student->update(['picture' => $picture]);
//        }
        $address = $this->addAddress($request);
        $classClassroomId = $this->checkClassClassroom($request->class_id, $request->classroom_id);
        if (!isset($classClassroomId)) {
            return $this->returnErrorMessage('input error', 400);
        }

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
            'class_classroom_id' => $classClassroomId->id,
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


