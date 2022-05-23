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
    //$credentials = request(['email', 'password']);

       $admin=Admin::query()->where('email',$request->email)->where('password',$request->password)->first();
        if(!isset($admin))
       {
        return $this->returnErrorMessage('admin Not Found', 404);}
        else{
            $token=$admin->createToken('user');

            $data['admin']=$admin;
            $data['type']='Bearer';
            $data['token']=$token->accessToken;

            return $this->returnData('admin Data', $data,'logged in successfully');
      }

}
}
