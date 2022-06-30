<?php

namespace App\Http\Controllers\Quiz;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Traits\basicFunctionsTrait;
use App\Traits\generalTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    use generalTrait, basicFunctionsTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = Quiz::query()->get();
        return $this->returnData('quiz', $quizzes, 'quiz');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
            $quiz = Quiz::query()->create([
                'quiz_name_id' => (int)$request->quizNameId,
                'C_Cr_T_S_id' => $C_CR_T_S_ID->id
        ]);
            $data[] = $quiz;
            return $this->returnData('quiz', $data, 'success');
        }
        return $this->returnErrorMessage('the tech does not have permission to create this quiz', 403);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Quiz $quiz)
    {
        $data[] = $quiz;
        return $this->returnData('quiz', $data, 'success');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quiz $quiz)
    {
        $quiz->update([

        ]);
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
}
