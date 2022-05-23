<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Auth\AuthenticationException;

class AuthAdminController extends Controller
{

    public function login(Request $request)
{
           $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {

            $user = $request->user();


            $token=$user->createToken('admins');
            return response()->json(['token' => $token], 200);

        } else {
           return response()->json(['error' => 'UnAuthorised'], 401);
        }
}
}
