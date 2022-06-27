<?php

namespace App\Http\Controllers\subject;

use App\Http\Controllers\Controller;
use App\Models\Claass;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\SubjectClass;
use App\Models\Teacher;

class SubjectClassController extends Controller
{
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
        $class = Claass::find($request->class_id);

          // $class->subjects()->attach($request->subject_id,['teacher_id'=>$request->teacher_id]);

        //   $class->subjects()->syncWithoutDetaching([$request->subject_id => ['teacher_id' => $teacher['teacher_id']]]);

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
}
