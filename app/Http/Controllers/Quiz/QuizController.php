<?php

namespace App\Http\Controllers\Quiz;

use App\Http\Controllers\Controller;
use App\Models\ClassClassroom;
use App\Models\Exam;
use App\Models\Quiz;
use App\Traits\basicFunctionsTrait;
use App\Traits\generalTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\True_;
use App\Models\SubjectMark;
class QuizController extends Controller
{
    use generalTrait, basicFunctionsTrait;



    public function index()
    {
        $quizzes = Quiz::query()->get();
        return $this->returnData('quiz', $quizzes, 'quiz');
    }



    public function store(Request $request)
    {
        $name1=DB::table('quiz_names')
              ->where('id',$request->quizNameId)
               ->where('name','شفهي')
                ->first();
        $name2=DB::table('quiz_names')
              ->where('id',$request->quizNameId)
               ->where('name','اختبار')
                ->first();
        $subject_mark=SubjectMark::query()
         ->where('subject_id',$request->subject_id)
          ->where('class_id',$request->class_id)
           ->first();

                if(isset($name1))

                   $mark=(80/100)*$subject_mark->mark;

                 if(isset($name2))

                    $mark=(20/100)*$subject_mark->mark;

        $check = $this->check($request);
        $responseFromCheckFun =  $check->getData();
        if ($responseFromCheckFun->status == false) {
           return $responseFromCheckFun;
        }else if ($responseFromCheckFun->status == true)  {

            $quiz = Quiz::query()->create([
                'mark' => $mark,
                'quiz_name_id' => (int)$request->quizNameId,
                'C_Cr_T_S_id' => $responseFromCheckFun->id
            ]);

            return $this->returnData('quiz', $quiz, 'success');
        }
        return $this->returnErrorMessage('input error', 400);
    }



    public function show(Quiz $quiz)
    {
        return $this->returnData('quiz', $quiz, 'success');
    }

    public function update(Request $request, Quiz $quiz)
    {
        $check = $this->check($request);
        $responseFromCheckFun =  $check->getData();
        if ($responseFromCheckFun->status == false) {
            return $responseFromCheckFun;
        }else if ($responseFromCheckFun->status == true) {
            $quiz->update([
                'quiz_name_id' => (int)$request->quizNameId,
                'C_Cr_T_S_id' => $responseFromCheckFun->id,
            ]);

            return $this->returnData('quiz', $quiz, 'success');
        }
        return $this->returnErrorMessage('input error', 400);

    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return $this->returnSuccessMessage('success');
    }

    public function markLadder(Quiz $quiz) {

        $quizInfo = $this->quizInfo($quiz);
        $questions = $quiz::query()->with('questions', function ($query) {
            $query->with('choices', function ($query) {
                $query->where('status', true);
            });
        })->get();

        $data['quizInfo'] = $quizInfo;
        $data['questions'] = $questions;
        return $this->returnData('data', $data, 'success');

    }

    public function check($request) {
        $teacherId = $request->teacher_id;
        $subjectId = $request->subject_id;
        $claassId = $request->class_id;
        $classroomId = $request->classroom_id;

        $classClassroom = $this->checkClassClassroom($claassId, $classroomId);
        if ($classClassroom == null) {
            return $this->returnErrorMessage('class or classroom not found', 404);
        }

        $teachSubject = $this->checkTeacherSubject($teacherId, $subjectId);
        if ($teachSubject == null) {
            return $this->returnErrorMessage('teacher or subject not found', 404);
        }

        $classClassroomId = $classClassroom->id;
        $teachSubjectId = $teachSubject->id;

        $C_CR_T_S_ID = DB::table('claass_classroom_teacher_subject')
            ->select('id')
            ->where('t_s_id', $teachSubjectId)
            ->where('c_cr_id', $classClassroomId)
            ->first();
        if (isset($C_CR_T_S_ID)) {
            return $this->returnData('id', $C_CR_T_S_ID->id, 'success');
        }else {
            return $this->returnErrorMessage('the tech does not have permission to create this quiz', 403);
        }
    }
}
