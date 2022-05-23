<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use App\Traits\generalTrait;

class AuthAdminController extends Controller
{
    use generalTrait;


    public function login(Request $request)
{
    $credentials = request(['email', 'password']);
    if (!Auth::attempt($credentials)){
        throw new AuthenticationException();
    }
//    $credentials = [$request->email, $request->password];

//    if (Auth::attempt($credentials)) {

            $admin = $request->user();

            $token = $admin->createToken('admin');
            $data['admin'] = $admin;
            $data['type'] = 'Bearer';
            $data['token'] = $token->accessToken;
            return $this->returnData('admin Data', $data,'logged in successfully');
//    }
//    else {
//            return $this->returnErrorMessage('admin Not Found', 404);
//    }
}
}
