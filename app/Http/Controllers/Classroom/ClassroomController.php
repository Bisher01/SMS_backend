<?php

namespace App\Http\Controllers\Classroom;

use App\Http\Controllers\Controller;
use App\Models\Claass;
use App\Models\Classroom;
use App\Traits\generalTrait;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    use generalTrait;

    public function index()
    {
        $classrooms = Classroom::query()->get();
        return $this->returnData('classroomms', $classrooms, 'all classroom');
    }

    public function store(Request $request)
    {
        $classroom = Classroom::query()->create([
            'name' => $request->name,
            'max_number' => $request->max_number,
        ]);
        return  $this->returnData('classroom', $classroom, 'added classroom successfully');

    }

    public function update(Request $request, Classroom $classroom)
    {
        $classroom->update([
            'name' => $request->name,
            'max_number' => $request->max_number,
        ]);
        return  $this->returnData('classroom', $classroom, 'updated classroom successfully');

    }

    public function destroy(Classroom $classroom)
    {
        $classroom->delete();
        return $this->returnSuccessMessage('deleted classroom successfully');
    }


}
