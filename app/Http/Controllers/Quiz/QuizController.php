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
                'season_id' => $request->season_id,
                'start' => $request->start,
                'end' => $request->end,
            ]);
            foreach ($request->questions as $question) {
                DB::table('question_quizzes')->insert([
                    'mark' => $question['mark'],
                    'question_id' => $question['question_id'],
                    'quiz_id' => $quiz->id
                ]);
            }
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


    public function getQuiz(Quiz $quiz) {
        $nowTime = Carbon::now();

            $quiz = Quiz::query()
                ->where('start', $nowTime->format('Y-m-d H:i:0'))
                ->orWhere('start', $nowTime->subMinute()->format('Y-m-d H:i:0'))
                ->where('id', $quiz->id)
                ->first();
//        }
        if (! isset($quiz)) {
            return $this->returnErrorMessage('quiz not found', 404);
        }
        $questions = $quiz->with(['questions' => function ($query) {
            $query->with('choices');
        }])->first();
        return $this->returnData('data', $questions, 'success');
    }


    public function studentQuizMark(Quiz $quiz, Student $student, Request $request)
    {
        $studentMark = 0;
        $nowTime = Carbon::now()->subMinutes(2)->toDateTimeString();

        if ($nowTime <= $quiz->end) {
            foreach ($request->questions as $question) {
                $status = DB::table('choices')
                    ->where('question_id', $question['question_id'])
                    ->where('id', $question['choice_id'])
                    ->select('status')
                    ->first();
                if (!$status == null) {
                    if ($status->status == 1) {
                        $question_mark = DB::table('question_quizzes')
                            ->where('quiz_id', $quiz->id)
                            ->where('question_id', $question['question_id'])
                            ->select('mark')
                            ->first();

                        $studentMark += $question_mark->mark;
                    }
                }
            }
            $quiz = DB::table('quiz_marks') ->insert([
                'quiz_id' => $quiz->id,
                'student_id' => $student->id,
                'mark' => $studentMark,
            ]);

            return $this->returnMark( $studentMark, 'success');

        }else if ($nowTime >= $quiz->end){
            $exam = DB::table('quiz_marks') ->insert([
                'quiz_id' => $quiz->id,
                'student_id' => $student->id,
                'mark' => $studentMark,
            ]);

            return $this->returnMark( $studentMark, 'GAMEOVER');
        }
        return $this->returnError('input error', 400);
    }

}
