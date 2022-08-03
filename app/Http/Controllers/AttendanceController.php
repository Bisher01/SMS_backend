<?php

namespace App\Http\Controllers;

use App\Traits\basicFunctionsTrait;
use App\Traits\generalTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    use basicFunctionsTrait, generalTrait;

    public function store(Request $request) {
        foreach ($request->students as $student) {
            $check  = DB::table('attendances')
                ->where('student_id', $student['student_id'])
                ->where('date', $request->date)->first();
            if (isset($check)) {
                DB::table('attendances')->update([
                    'status_id' => $request['status_id']
                ]);
            }
            DB::table('attendances')->update([
                'student_id' => $student['student_id'],
                'status_id' => $request['status_id'],
                'date' => $request->date
            ]);
        }
        return $this->returnSuccessMessage('success');
    }
}
