<?php

namespace App\Http\Controllers\Subject;

use App\Http\Controllers\Controller;
use App\Models\Claass;
use App\Models\Subject;
use App\Models\Teacher;
use App\Traits\generalTrait;
use Illuminate\Http\Request;

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
        $data[] = $subject;
        return $this->returnData('subject', $data, 'added subject successfully');
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
        $data[] = $subject;
        return $this->returnData('subject', $data, 'updated subject successfully');
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
