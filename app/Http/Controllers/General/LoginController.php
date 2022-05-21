<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Paarent;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $code = $request->code;
        if (Str::is('001*', $code)) {
            $student = Student::query()->where('code', $code)->first();
            if (!isset($student)) {
                return 'Not Found';
            } else {
                $token = $student->createToken('student');
                $data['student'] = $student;
                $data['type'] = 'Bearer';
                $data['token'] = $token->accessToken;

                return  [$data, 'logged in successfully'];
            }
        } elseif(Str::is('002*', $code)) {
            $parent = Paarent::query()->where('code', $code)->first();
            if (!isset($parent)) {
                return 'Not Found';
            } else {
                $token = $parent->createToken('parent');
                $data['parent'] = $parent;
                $data['type'] = 'Bearer';
                $data['token'] = $token->accessToken;

                return [$data, 'logged in successfully'];
            }
        }
//elseif(Str::is('003*', $studentNumber)){
//            dd('employee');
//        }
        else {
                return 'not found';
            }

        }
}
