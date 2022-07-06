<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use App\Models\Claass;
use App\Models\Question;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Traits\generalTrait;
use Illuminate\Support\Facades\DB;
class QuestionController extends Controller
{
    use generalTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions=Question::query()->get();
        return $this->returnAllData('questions', $questions, 'all questions');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $classClassroom = DB::table('claass_classrooms')
        ->where('class_id',$request->class_id)
        ->select('id')
        ->first();

        $teacherSubjectClass = DB::table('teacher__subjects')
        ->where('teacher_id',$request->teacher_id)
        ->where('subject_id',$request->subject_id)
        ->where('class_classroom_id',$classClassroom->id)
        ->select('id')
        ->first();

        foreach ($request->question as $question) {
            $newQuestion = Question::query()->create([
                'text' => $question['text'],
                'question_type_id' => $question['question_type_id'],
                'teacher_subjects_id' => $teacherSubjectClass ->id
            ]);
            foreach ($question['chioces'] as $chioce) {
                $newQuestion->choices()->create([
                    'text' => $chioce['text'],
                    'status' => $chioce['status']
                ]);
            }
        }
        return  $this->returnSuccessMessage('success');
    }


    public function update(Request $request,Question $question)
    {
        $classClassroom = DB::table('claass_classrooms')
        ->where('class_id',$request->class_id)
        ->select('id')
        ->first();

        $teacherSubjectClass = DB::table('teacher__subjects')
        ->where('teacher_id',$request->teacher_id)
        ->where('subject_id',$request->subject_id)
        ->where('class_classroom_id',$classClassroom->id)
        ->select('id')
        ->first();

        $question->update([
            'text'=>$request->text,
            'question_type_id' => $request->question_type_id,
            'teacher_subjects_id' => $teacherSubjectClass ->id
        ]);

         return  $this->returnData('questions', $question, 'updated question successfully');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return $this->returnSuccessMessage('deleted question successfully');
    }
}
