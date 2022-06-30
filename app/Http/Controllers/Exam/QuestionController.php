<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Traits\generalTrait;
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
        return $this->returnData('questions', $questions, 'all questions');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->question as $question) {
            $newQuestion = Question::query()->create([
                'text' => $question['text'],
                'question_type_id' => $question['question_type_id']
            ]);
            foreach ($question['chioces'] as $chioce) {
                $newQuestion->choices()->create([
                    'text' => $chioce['text'],
                    'status' => $chioce['status']
                ]);
            }
            $data[] = $newQuestion;
        }
        return  $this->returnData('data', $data, 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show(Question $question)
    // {
    //     $data[] = $question;
    //     return $this->returnData('question', $data,'success');
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Question $question)
    {
        $question->update([

            'text'=>$request->text,
            'question_type_id' => $request->question_type_id,

        ]);

        $data[] = $question;
        return  $this->returnData('questions', $data, 'updated question successfully');
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
