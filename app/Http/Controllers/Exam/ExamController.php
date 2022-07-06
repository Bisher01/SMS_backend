<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use App\Models\Choice;
use App\Models\Exam;
use App\Models\ExamName;
use App\Models\Question;
use App\Models\QuestionExam;
use App\Models\Student;
use App\Models\SubjectMark;
use App\Traits\generalTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
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
        return $this->returnAllData('exams', $exams, 'all exams');

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

        $name1 = ExamName::query()
            ->where('id',$request->exam_name_id)
            ->where('name','مذاكرة اولى')
            ->first();
        $name2 = ExamName::query()
            ->where('id',$request->exam_name_id)
            ->where('name','مذاكرة ثانية')
            ->first();
        $name3 = ExamName::query()
            ->where('id',$request->exam_name_id)
            ->where('name','مذاكرة فصلية')
            ->first();
        $name4 = ExamName::query()
            ->where('id',$request->exam_name_id)
            ->where('name','امتحان')
            ->first();


        $subject_mark = SubjectMark::query()
            ->where('id',$request->subject_mark_id)->first();

        if(isset($name1)||isset($name2))

            $mark=(10/100)*$subject_mark->mark;

        if(isset($name3) )

            $mark=(20/100)*$subject_mark->mark;

        if(isset($name4))

            $mark=(40/100)*$subject_mark->mark;
        $subjectClassMark = DB::table('subject_mark')->select('id')
            ->where('subject_id', $request->subject_id)
            ->where('class_id', $request->class_id)
            ->first();
        if (!isset($subjectClassMark)) {
            return $this->returnErrorMessage('there is not relationship between class & subject', 404);
        }
        $exam = Exam::query()->create([

            'mark' => $mark,
            'exam_name_id' => $request->exam_name_id,
            'subject_mark_id' => $request->subject_mark_id,
            'season_id' => $request->season_id,
            'start' => $request->start,
            'end' => $request->end,


        ]);

        return $this->returnData('exam', $exam, 'added exams successfully');
    }




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
            'exam_name_id' => $request->exam_name_id,
            'subject_mark_id' => $request->subject_mark_id

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

    public function studentMark(Request $request,Exam $exam,Student $student)
    {
        $student_mark = 0;

        $examEndTime = Exam::query()->select('end')->where('id', $exam->id)->first();
        $nowTime = Carbon::now()->subMinutes(2)->toDateTimeString();
        if ($nowTime <= $examEndTime->end){
            foreach($request->question as $question){
                $status = DB::table('choices')
                    ->where('question_id',$question['id'])
                    ->where('id',$question['choise'])
                    ->select('status')
                    ->first();
                if (!$status == null) {
                    if ($status->status == 1) {
                        $question_mark = DB::table('question_exams')
                            ->where('exam_id', $exam->id)
                            ->where('question_id', $question['id'])
                            ->select('mark')
                            ->first();

                        $student_mark += $question_mark->mark;
                    }
                }
            }
            $exam = DB::table('exam_marks') ->insert([
                'exam_id' => $exam->id,
                'student_id' => $student->id,
                'mark' => $student_mark,
            ]);

            return $this->returnData('mark', $student_mark, 'success');

        }else if ($nowTime >= $examEndTime->end){
            $exam = DB::table('exam_marks') ->insert([
                'exam_id' => $exam->id,
                'student_id' => $student->id,
                'mark' => $student_mark,
            ]);

            return $this->returnData('mark', $student_mark, 'GAMEOVER');

        }
        return $this->returnError('input error', 400);

    }
}
