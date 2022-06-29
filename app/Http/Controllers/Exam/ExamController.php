<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Traits\generalTrait;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    use generalTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams=Exam::query()->get();
        return $this->returnData('exams', $exams, 'all exams');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $exam=Exam::query()->create([

            'mark'=>$request->mark,
            'subject_id' => $request->subject_id,
            'exam_name_id' => $request->exam_name_id,
            'class_id' => $request->class_id

        ]);

        $data[] = $exam;
        return  $this->returnData('exam', $data, 'added exams successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        $data[] = $exam;
        return $this->returnData('exam', $data,'success');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Exam $exam)
    {
        $exam->update([

            'mark'=>$request->mark,
            'subject_id' => $request->subject_id,
            'exam_name_id' => $request->exam_name_id,
            'class_id' => $request->class_id

        ]);

        $data[] = $exam;
        return  $this->returnData('exam', $data, 'updated exam successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {

        $exam->delete();
        return $this->returnSuccessMessage('deleted exam successfully');

    }
}
