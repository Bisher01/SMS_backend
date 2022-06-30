<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use App\Models\Choice;
use App\Models\Question;
use App\Traits\generalTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChoiseController extends Controller
{
    use generalTrait;
    public function index()
    {
        $choices=Choice::query()->get();
        return $this->returnData('choices', $choices, 'all choices');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Question $question)
    {
        $arrayChioces = $request->chioces;
        $choices = DB::table('choices')->select('status')
            ->where('question_id', $question->id)
            ->where('status', true)
            ->first();
        foreach ($arrayChioces as $item) {
            if (isset($choices)) {
                if ($item['status'] == true) {
                    return $this->returnErrorMessage('must enter one correct answer for this question', 400);
                }
            }
            $choice = Choice::query()->create([
                'text' => $item['text'],
                'status' => $item['status'],
                'question_id' => $question->id
            ]);
            $data[] = $choice;
        }
        return  $this->returnData('choices', $data, 'added choices successfully');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Choice $choice)
    {
       $choice->update([
        'text'=> $request->text,
        'status' => $request->status,
        'question_id' => $request->question_id
       ]);

        $data[] = $choice;
        return  $this->returnData('choice', $data, 'updated choice successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Choice $choice)
    {
        $choice->delete();
        return $this->returnSuccessMessage('deleted choice successfully');

    }
}
