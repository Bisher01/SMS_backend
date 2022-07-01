<?php

namespace App\Http\Controllers\Subject;

use App\Http\Controllers\Controller;
use App\Models\Claass;
use App\Models\Subject;
use App\Models\Teacher;
use App\Traits\generalTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    use generalTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::query()->get();
        return $this->returnData('subjects', $subjects, 'all subjects');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $subject = Subject::query()->create([
            'name' => $request->subject_name
        ]);

        foreach( $request->class_id as $key=>$insert){

           DB::table('subject_mark')->insert([
                        'class_id' => $request->class_id[$key],
                        'mark' => $request->mark[$key],
                        'subject_id' =>$subject->id,
                   ]);
                   foreach( $request->content[$key] as $key1=>$insert1){
                    DB::table('syllabi')->insert([
                     'class_id' => $request->class_id[$key],
                     'content' => $request->content[$key][$key1],
                     'subject_id' =>$subject->id,
                    ]);
                }
                }
             return $this->returnSuccessMessage('add subject & choose its class&syllabi successfully');


    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $subject->update([
            'name' => $request->subject_name
        ]);
        return $this->returnData('subject', $subject, 'updated subject successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return $this->returnSuccessMessage('deleted subject successfully');
    }


}
