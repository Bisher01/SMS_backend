<?php

namespace App\Http\Controllers\syllabi;

use App\Http\Controllers\Controller;
use App\Models\Claass;
use App\Models\Subject;
use App\Models\Subject_Class;
use App\Models\SubjectClass;
use App\Models\Syllabi;
use App\Models\Teacher;
use App\Traits\generalTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class syllabiController extends Controller
{
    use generalTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $syllabi = Syllabi::query()->get();
        return $this->returnData('syllabi', $syllabi, 'syllabi');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $path  = null;
        $subName = Subject::query()->select('name')->where('id', $request->subject_id)->first();
//        dd($subName);
        $classNmae = Claass::query()->select('name')->where('id', $request->class_id)->first();
        $time  = Carbon::now();
        if ($request->hasFile('content')) {
            $path = '/'.$request->file('content')
                    ->store($time->format('Y').'/syllabi/'.$subName->name. '/'. $classNmae->name);
        }

        $syllabi = Syllabi::query()->create([
            'content' => $path,
            'class_id' => $request->class_id,
            'subject_id' => $request->subject_id,
        ]);
        $data[] = $syllabi;
        return $this->returnData('syllabi', $data, 'added syllabi success');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Syllabi $syllabi)
    {
        $pdf  = null;
        $time  = Carbon::now();
        if ($request->hasFile('content')) {
                if (Storage::exists($syllabi->content)) {
                    Storage::delete($syllabi->content);
//                    Storage::deleteDirectory($time->format('Y').'/syllabi/student/');
                    }
            $pdf = '/'.$request->file('content')
                    ->store($time->format('Y').'/syllabi/subject/');
        }

        $syllabi->update([
            'content' => $pdf,
            'subject_class_id' => $request->subject_class_id
        ]);
        $data[] = $syllabi;
        return $this->returnData('syllabi', $data, 'updated syllabi success') ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Syllabi $syllabi)
    {
        $syllabi->delete();
        return  $this->returnSuccessMessage('deleted success');
    }
}
