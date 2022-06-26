<?php

namespace App\Http\Controllers\Classroom;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Traits\generalTrait;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    use generalTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classrooms = Classroom::query()->get();
        return $this->returnData('classroomms', $classrooms, 'all classroom');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $classroom = Classroom::query()->create([
            'name' => $request->name,
            'max_number' => $request->max_number,
        ]);
        return  $this->returnData('classroom', $classroom, 'added classroom successfully');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classroom $classroom)
    {
        $classroom->update([
            'name' => $request->name,
            'max_number' => $request->max_number,
        ]);
        return  $this->returnData('classroom', $classroom, 'updated classroom successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classroom $classroom)
    {
        $classroom->delete();
        return $this->returnSuccessMessage('deleted classroom successfully');
    }
}
