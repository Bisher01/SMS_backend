<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Traits\basicFunctionsTrait;
use App\Traits\generalTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckExam extends Controller
{
    use basicFunctionsTrait, generalTrait;

    public function getAllExam() {
        $exams = DB::table('exams')->get();
        return $this->returnAllData('data', $exams, 'success');
    }

    public function acceptExam(Exam $exam) {
        DB::table('exams')->where('id', $exam->id)->update([
            'active' => 1
        ]);
    }
    public function editExamDate(Exam $exam, Request $request) {
        $class_id = $exam->subjectMark->class_id;
        $subjectsSameClass = DB::table('subject_mark')
            ->where('class_id', $class_id)
            ->get();

        foreach ($subjectsSameClass as $item) {
            $allExam = Exam::query()->where('subject_mark_id', $item->id)->get();
            foreach ($allExam as $value) {
                $start = Carbon::parse($value->start)->subMinute();
                $end = Carbon::parse($value->end);
                $checkStart = Carbon::parse($request->start)->between($start, $end);
                $checkEnd = Carbon::parse($request->end)->between($start, $end);
                if ($checkStart || $checkEnd) {
                    return $this->returnErrorMessage('already this class has exam in this date', 400);
                }
            }
        }
        $exam->update([
            'start' => $request->start,
            'end' => $request->end
        ]);
        return $this->returnSuccessMessage('success');
    }
}
