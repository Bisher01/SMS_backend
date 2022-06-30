<?php

namespace App\Http\Controllers\Exam;
use App\Http\Controllers\Controller;
use App\Models\Choice;
use App\Models\Question;
use App\Traits\generalTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

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
        $choices = DB::table('choices')->select('status')
            ->where('question_id', $question->id)
            ->where('status', true)
            ->first();
        if (isset($choices)) {
            if ($request->status == true) {
                return $this->returnErrorMessage('must enter one correct answer for this question', 400);
            }
        }
        $choise=Choice::query()->create([

            'text'=> $request->text,
            'status' => $request->status,
            'question_id' => $question->id,

            ]);

       $data[] = $choise;
        return  $this->returnData('choices', $choise, 'added choices successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request,Choice $choice)
    {
       $choice->update([
        'text'=> $request->text,
        'question_id' => $request->question_id
       ]);

        if($request->status==true)
        $a=Choice::query()->where('question_id',$choice->question_id)->where('status',true)->first();

        if(isset($a))
            return 'you already have right choise';

        $choice->update([
            'status'=> $request->status,

           ]);
           $data[] = $choice;
          return  $this->returnData('choice', $choice, 'updated choice successfully');
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
