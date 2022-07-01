<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamName;
use App\Models\Question;
use App\Models\QuestionExam;
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
        $exams = Exam::query()->get();
        return $this->returnData('exams', $exams, 'all exams');

    }

    public function mark_ladder(Exam $exam)
    {
        $exam_mark = Exam::where('id', $exam->id)->get('mark');
        $exam_name = ExamName::where('id', $exam->exam_name_id)->get('name');
        $a = QuestionExam::where('exam_id', $exam->id)->pluck('question_id');
        foreach ($a as $aa) {

            $question_text[] = Question::query()->where('id', $aa)->with('choices', function ($query) {
                return $query->where('status', true);
            })->get();

            // $choise[]=Choice::query()->where('question_id',$aa)->where('status',true)->pluck('text');

//          return $this->returnData('exam_info', $exam_info, 'exam_info');

        }

//        $data['exam_mark']=$exam_mark;
//        $data['exam_name']=$exam_name;
//        $data['question_text']=$question_text;
        //  $data['choise']=$choise;

//
//        return $this->returnData('exam_info', $data, 'exam_info');


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $exam = Exam::query()->create([

            'mark' => $request->mark,
            'subject_id' => $request->subject_id,
            'exam_name_id' => $request->exam_name_id,
            'class_id' => $request->class_id

        ]);

        return $this->returnData('exam', $exam, 'added exams successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        return $this->returnData('exam', $exam, 'success');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam)
    {
        $exam->update([

            'mark' => $request->mark,
            'subject_id' => $request->subject_id,
            'exam_name_id' => $request->exam_name_id,
            'class_id' => $request->class_id

        ]);

        return $this->returnData('exam', $exam, 'updated exam successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        $exam->delete();
        return $this->returnSuccessMessage('deleted exam successfully');

    }
}
