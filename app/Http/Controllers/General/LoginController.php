<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Mentor;
use App\Models\Paarent;
use App\Models\Student;
use App\Models\Teacher;
use App\Traits\generalTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class LoginController extends Controller
{
    use generalTrait;
    public function login(LoginRequest $request)
    {
        $code = $request->code;
        $firstName = $request->f_name;
        $lastName = $request->l_name;

        // login for student
        if (Str::is('001*', $code)) {
            $student = Student::query()
                ->where('code', $code)
                ->where('f_name', $firstName)
                ->where('l_name', $lastName)->first();
            if (!isset($student)) {
                return $this->returnErrorMessage('Student Not Found', 404);
            } else {
                $token = $student->createToken('student', ['student']);
                $data['student'] = $student;
                $data['Bearer'] = 'Bearer';
                $data['token'] = $token->accessToken;

                return $this->returnData('Student Data', $data,'logged in successfully');
            }

            // login for parent
        } elseif(Str::is('002*', $code)) {
            $parent = Paarent::query()
                ->where('code', $code)->first()
                ->child()->where('f_name', $firstName)
                ->where('l_name', $lastName)
                ->first();
            if (!isset($parent)) {
                return $this->returnErrorMessage('Student Not Found', 404);
            } else {
                $token = $parent->createToken('parent', ['parent']);
                $data['parent'] = $parent;
                $data['Bearer'] = 'Bearer';
                $data['token'] = $token->accessToken;

                return $this->returnData('Parent Data', $data,'logged in successfully');
            }

            // login for teacher
        } elseif(Str::is('003*', $code)){
            $teacher = Teacher::query()
                ->where('code', $code)
                ->where('f_name', $firstName)
                ->where('l_name', $lastName)->first();
            if (!isset($teacher)) {
                return $this->returnErrorMessage('Teacher Not Found', 404);
            } else {
                $token = $teacher->createToken('teacher', ['teacher']);
                $data['teacher'] = $teacher;
                $data['Bearer'] = 'Bearer';
                $data['token'] = $token->accessToken;

                return $this->returnData('Teacher Data', $data,'logged in successfully');
            }
        }
//        login for mentor
        elseif(Str::is('004*', $code)){
            $mentor = Mentor::query()
                ->where('code', $code)
                ->where('f_name', $firstName)
                ->where('l_name', $lastName)
                ->first();
            if (!isset($mentor)) {
                return $this->returnErrorMessage('Mentor Not Found', 404);
            } else {
                $token = $mentor->createToken('mentor', ['mentor']);
                $data['mentor'] = $mentor;
                $data['Bearer'] = 'Bearer';
                $data['token'] = $token->accessToken;

                return $this->returnData('Mentor Data', $data,'logged in successfully');
            }
        }
        else {
                return 'not found';
            }

        }
}
