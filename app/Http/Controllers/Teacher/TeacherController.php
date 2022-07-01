<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Traits\basicFunctionsTrait;
use Illuminate\Support\Facades\Storage;
use App\Traits\generalTrait;
class TeacherController extends Controller
{
    use generalTrait, basicFunctionsTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers=Teacher::query()->get();
        return $this->returnData('teacher', $teachers,'success');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $time = Carbon::now();
        if ($request->hasFile('picture')) {
            $picture = '/'.$request->file('picture')
                    ->store($time->format('Y').'/images/teacher/'. $request->f_name. '_'. $request->l_name);
        }
        else{
            $picture=null;
        }

        $address = $this->addAddress($request);

        $teacher = Teacher::query()->create([
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'email' => $request->email,
            'code' =>'003',
            'picture' => $picture,
            'joining_date' => $request->joining_date,
            'salary' => $request->salary,
            'address_id' => $address->id,
            'religion_id' => $request->religion_id,
            'gender_id' => $request->gender_id,
            'grade_id' => $request->grade_id,
        ]);

        $teacher->update([
            'code' =>  '003' .$teacher->grade_id.  rand(0, 99) . $teacher->id . rand(100, 999) . $time->format('H') ,
        ]);

        return $this->returnData('teacher', $teacher,'signup successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        return $this->returnData('teacher', $teacher,'success');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        $picture=null;
        $time = Carbon::now();
        if ($request->hasFile('picture')) {
            if (Storage::exists($teacher->picture)) {
                Storage::delete($teacher->picture);
                Storage::deleteDirectory($time->format('Y').'/images/teacher/'. $teacher->f_name. '_'. $teacher->l_name);
            }
            $picture =  '/'.$request->file('picture')
                    ->store($time->format('Y').'/images/teacher/'. $request->f_name. '_'. $request->l_name);
            $teacher->update(['picture' => $picture]);
        }

        $address = $this->addAddress($request);

        $teacher->update([
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'email' => $request->email,
            'picture' => $picture,
            'joining_date' => $request->joining_date,
            'salary' => $request->salary,
            'address_id' =>  $address->id,
            'religion_id' => $request->religion_id,
            'gender_id' => $request->gender_id,
            'grade_id' => $request->grade_id,
        ]);

        return $this->returnData('teacher', $teacher,'updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return $this->returnSuccessMessage('deleted teacher successfully');
    }


}
