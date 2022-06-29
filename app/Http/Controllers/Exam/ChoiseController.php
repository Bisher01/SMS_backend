<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use App\Models\Choice;
use App\Traits\generalTrait;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        $choices=Choice::query()->create([

            'text'=>$request->text,
            'status' => $request->status,
            'question_id' => $request->question_id

        ]);

        $data[] = $choices;
        return  $this->returnData('choices', $data, 'added choices successfully');

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
    public function update(Request $request,Choice $choice)
    {
       $choice->update([
        'text'=> $request->text,
        'status' => $request->status,
        'question_id' => $request->question_id
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
