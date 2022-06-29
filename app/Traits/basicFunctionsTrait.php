<?php
namespace App\Traits;

use App\Models\Address;
use App\Models\Blood;
use App\Models\ClassClassroom;
use Illuminate\Support\Facades\DB;


trait basicFunctionsTrait{
    use generalTrait;
    public function addAddress($request) {

         $address  = Address::query()
            ->where('city', $request->city)
            ->where('street', $request->street)
            ->where('town', $request->town)
            ->first();
        if (!isset($address)) {
            $address = Address::query()->create([
                'city' => $request->city,
                'street' => $request->street,
                'town' => $request->town,
            ]);
            return $address;
        }
        return $address;


    }
    public function getBloods() {
        $bloods = Blood::query()->get();
        return $bloods;
    }

    public function checkClassClassroom($claassId, $classroomId) {
        $classClassroom = ClassClassroom::query()
            ->select('id')
            ->where('class_id', $claassId)
            ->where('classroom_id', $classroomId)
            ->first();
        return $classClassroom;
    }

    public function checkTeacherSubject($teacherId, $subjectId) {
        $teachSubject = DB::table('teacher__subjects')
            ->select('id')
            ->where('subject_id', $subjectId)
            ->where('teacher_id', $teacherId)
            ->first();
        return $teachSubject;
    }
}
