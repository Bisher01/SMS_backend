<?php

namespace App\Http\Controllers\Resultant;

use App\Http\Controllers\Controller;
use App\Models\ExamMark;
use App\Models\Quiz;
use App\Models\QuizMarks;
use App\Models\Student;
use App\Traits\basicFunctionsTrait;
use App\Traits\generalTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultantController extends Controller
{
    use generalTrait, basicFunctionsTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function resultantStudent(Student $student) {

        $quizzes =  $student->quizzes;
        $avgQuizMarksQ = 0;
        $avgQuizMarks = 0;
        foreach ($quizzes as $quiz) {
            if ($quiz->quiz_name_id == 2) {
                $avgQuizMarksQ = QuizMarks::query()
                    ->where('student_id', $student->id)
                    ->where('quiz_id', $quiz->id)
                    ->average('mark');
            }
            if ($quiz->quiz_name_id == 1) {
                $avgQuizMarks = QuizMarks::query()
                    ->where('student_id', $student->id)
                    ->where('quiz_id', $quiz->id)
                    ->average('mark');
            }

        }
        $data['شفهي'] = $avgQuizMarks;
        $data['اختبار'] = $avgQuizMarksQ;
        return $data ;



        $avgExamMarks = ExamMark::query()
            ->where('student_id', $student->id)->average('mark');

        $data['student'] = $student;
        $data['avgQuizMarks'] = $avgQuizMarks;
        $data['avgExamMarks'] = $avgExamMarks;

        return $this->returnData('resultant', $data, 'success');


    }
}
