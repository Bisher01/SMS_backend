<?php

namespace App\Http\Controllers\Resultant;

use App\Http\Controllers\Controller;
use App\Models\ClassClassroom;
use App\Models\ExamMark;
use App\Models\Quiz;
use App\Models\QuizMarks;
use App\Models\Student;
use App\Models\Subject;
use App\Traits\basicFunctionsTrait;
use App\Traits\generalTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultantController extends Controller
{
    use generalTrait, basicFunctionsTrait;

    public function resultantStudent(Student $student) {

        $class = $student->claass;
        $classSubjects = $class->subjects;
        $classroom = $student->classroom;

        $classClassroom = ClassClassroom::query()
            ->where('class_id',$class->id)
            ->where('classroom_id',$classroom->id)
            ->first();

        $numberOfQuizes = 0;
        $sumOfQuizeMarks = 0;
        $sumOfOralMarks = 0;
        $numberOfOral = 0;
        $sumOfSExamMarks = 0;
        $sumOfLExamMarks = 0;
        $examResult = 0;
        $LExamResult = 0;
        $i = 0;
        $array[] = 0;


        foreach ($classSubjects as $classSubjectt) {
            $subjects = DB::table('teacher__subjects')
                ->where('subject_id', $classSubjectt->id)
                ->where('class_classroom_id',$classClassroom->id)
                ->get();

            foreach ($subjects as $subjectt) {

                $quizzes = DB::table('quizzes')
                    ->where('teacher_subject_id', $subjectt->id)
                    ->get();

                foreach ($quizzes as $quiz) {

                    $studentQuize = DB::table('quiz_marks')
                        ->where('student_id', $student->id)
                        ->where('quiz_id', $quiz->id)
                        ->first();

                        if ($quiz->quiz_name_id == 1) {
                            $numberOfOral++;
                            $sumOfOralMarks += $studentQuize->mark;
                        }

                        if ($quiz->quiz_name_id == 2) {
                            $numberOfQuizes++;
                            $sumOfQuizeMarks += $studentQuize->mark;
                        }
                }
                if($numberOfQuizes==0)
                {
                    $quizeResult = 0;
                }else{

                    $quizeResult = $sumOfQuizeMarks / $numberOfQuizes;
                }
                $numberOfQuizes = 0;
                $sumOfQuizeMarks = 0;
                if($numberOfOral == 0)
                {
                    $oralResult = 0;
                }else{

                    $oralResult = $sumOfOralMarks / $numberOfOral ;
                }

                $numberOfOral = 0;
                $sumOfOralMarks = 0;

            }

            $classSubjects = DB::table('subject_mark')
                ->where('subject_id', $classSubjectt->id)
                ->where('class_id', $class->id)
                ->first();

        $exams = DB::table('exams')
            ->where('subject_mark_id',$classSubjects->id)
            ->get();

        foreach ($exams as $exam){

            $studentExams = DB::table('exam_marks')
                ->where('student_id', $student->id)
                ->where('exam_id', $exam->id)
                ->first();

                if ($exam->exam_name_id == 1 || $exam->exam_name_id == 2)
                {
                    $sumOfSExamMarks += $studentExams->mark;
                    $examResult = $sumOfSExamMarks/2;
                }

                if ($exam->exam_name_id == 3) {
                    $examResult = $studentExams->mark;
                }
                if ($exam->exam_name_id == 4) {
                    $LExamResult = $studentExams->mark;

                }
            }

            $array[$i] = [$examResult,$LExamResult,$quizeResult , $oralResult];
            $i++;
            $quizeResult = 0;
            $oralResult = 0;
            $examResult =0;
            $LExamResult=0;

        }
        return $array;

//        $subjectMaxMark = $classSubject->mark;
//        $totalSeasonMark = array_sum($data);

//        return $this->returnData('resultant', $data, 'success');
    }
}
