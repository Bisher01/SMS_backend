<?php

namespace App\Http\Controllers\Quiz;

use App\Http\Controllers\Controller;
use App\Models\Claass;
use App\Models\ClassClassroom;
use App\Models\Classroom;
use App\Models\Exam;
use App\Models\QuestionQuiz;
use App\Models\Quiz;
use App\Models\Student;
use App\Models\Subject;
use App\Models\TeacherSubject;
use App\Traits\basicFunctionsTrait;
use App\Traits\generalTrait;
use Carbon\Carbon;
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
        return $this->returnAllData('quiz', $quizzes, 'quiz');
    }

    public function store(Request $request)
    {
        $teacherId = $request->teacher_id;
        $subjectId = $request->subject_id;
        $claassId = $request->class_id;
        $classroomId = $request->classroom_id;
        $startDate = $request->start_date;


        $name1 = DB::table('quiz_names')
              ->where('id',$request->quizNameId)
               ->where('name','شفهي')
                ->first();
        $name2 = DB::table('quiz_names')
              ->where('id',$request->quizNameId)
               ->where('name','اختبار')
                ->first();
        $subject_mark = SubjectMark::query()
         ->where('subject_id',$request->subject_id)
          ->where('class_id',$request->class_id)
           ->first();

        if (!isset($subject_mark)) {
           return $this->returnErrorMessage('there is not relationship between subject and class', 404);
        }
        if(isset($name1))
            $mark=(80/100)*$subject_mark->mark;

        if(isset($name2))
            $mark=(20/100)*$subject_mark->mark;

        $check = $this->checkTeacherSubject($teacherId, $subjectId, $claassId, $classroomId);
        if (isset($check)) {
            $quiz = Quiz::query()->create([
                'mark' => $mark,
                'quiz_name_id' => (int)$request->quizNameId,
                'teacher_subject_id' => $check->id,
                'start_date' => $startDate
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
        $teacherId = $request->teacher_id;
        $subjectId = $request->subject_id;
        $claassId = $request->class_id;
        $classroomId = $request->classroom_id;

        $check = $this->checkTeacherSubject($teacherId, $subjectId, $claassId, $classroomId);
        if (isset($check)) {
            $quiz->update([
                'quiz_name_id' => (int)$request->quizNameId,
                'teacher_subject_id' => $check->id,
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


    public function checkAnswer(Request $request) {
        $studentId = $request->student_id;
        $subjectName = $request->subjectName;
        $classroom = $request->classroom_name;
        $classId = $request->classId;
        $nowTime = Carbon::now();


        $subjectId = Subject::query()->where('name', $subjectName)->first('id');
        if (! isset($subjectId)) {
            return $this->returnErrorMessage('subject not found',404);
        }

        $classroomId = Classroom::query()->where('name', $classroom)->first('id');
        if (! isset($classroomId)) {
            return $this->returnErrorMessage('classroom not found', 404);
        }

        if (! Claass::query()->find($classId)) {
            return $this->returnErrorMessage('class not found', 404);
        }

        $classClassroomId = $this->checkClassClassroom($classId, $classroomId->id);

        if (! isset($classClassroomId)) {
            return $this->returnErrorMessage('class classroom not found', 404);
        }

        $teacherSubjects = TeacherSubject::query()
            ->where('subject_id', $subjectId->id)
            ->where('class_classroom_id', $classClassroomId->id)
        ->get();

         foreach ($teacherSubjects as $teacherSubject) {
            $quiz = Quiz::query()
                ->where('start', $nowTime->format('Y-m-d H:i:0'))
                ->orWhere('start', $nowTime->subMinute()->format('Y-m-d H:i:0'))
                ->where('teacher_subject_id', $teacherSubject->id)
                ->first();
         }
         if (! isset($quiz)) {
             return $this->returnErrorMessage('quiz not found', 404);
         }
         $questions = $quiz->with(['questions' => function ($query) {
             $query->with('choices');
         }])->first();

         return $this->returnData('data', $questions, 'success');

    }





//    public function check($request) {
//        $teacherId = $request->teacher_id;
//        $subjectId = $request->subject_id;
//        $claassId = $request->class_id;
//        $classroomId = $request->classroom_id;
//
//        $classClassroom = $this->checkClassClassroom($claassId, $classroomId);
//        if ($classClassroom == null) {
//            return $this->returnErrorMessage('class or classroom not found', 404);
//        }
//
//        $teachSubject = $this->checkTeacherSubject($teacherId, $subjectId);
//        if ($teachSubject == null) {
//            return $this->returnErrorMessage('teacher or subject not found', 404);
//        }
//
//        $classClassroomId = $classClassroom->id;
//        $teachSubjectId = $teachSubject->id;
//
//        $C_CR_T_S_ID = DB::table('claass_classroom_teacher_subject')
//            ->select('id')
//            ->where('t_s_id', $teachSubjectId)
//            ->where('c_cr_id', $classClassroomId)
//            ->first();
//        if (isset($C_CR_T_S_ID)) {
//            return $this->returnData('id', $C_CR_T_S_ID->id, 'success');
//        }else {
//            return $this->returnErrorMessage('the tech does not have permission to create this quiz', 403);
//        }
//    }
}