<?php

namespace App\Http\Controllers\Academic_year;

use App\Http\Controllers\Controller;
use App\Models\Academic_year;
use App\Models\Student;
use App\Traits\generalTrait;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
 use generalTrait;
    public function index()
    {
        $academicYears = Academic_year::query()->get();

        return $this->returnData('Academic Years', $academicYears, 'List Of Academic Years');
    }


    public function store(Request $request)
    {
        $academicYear = Academic_year::query()->create([
            'date' => $request->date,
        ]);
        return $this->returnData('Academic Year', $academicYear, 'Added Successfully');
    }


    public function show(Academic_year $yearId)
    {
        return $this->returnData('Academic Year', $yearId, 'success');
    }


    public function update(Request $request, Academic_year $yearId)
    {
        $yearId->update([
            'date' => $request->date,
        ]);
        return $this->returnData('Academic Year', $yearId, 'Updated Successfully');
    }


    public function destroy(Academic_year $yearId)
    {
        $yearId->delete();
        return $this->returnSuccessMessage('Deleted Successfully');
    }
}
