<?php

namespace App\Http\Controllers;

use App\Traits\basicFunctionsTrait;
use App\Traits\generalTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\setting;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    use generalTrait, basicFunctionsTrait;
    public function index()
    {
        $settings = setting::query()->get();
       return $this->returnAllData('settings', $settings, 'success');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $settings=setting::query()->create([
            'name'=>$request->name,
            'address_id'=>$request->address_id,
            'admin_id'=>$request->admin_id,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'logo'=>$request->logo,

        ]);
        return $settings;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
   /* public function show(Student $request)
    {
        $user_id->products()->whereDate('expired_date', '>=', now());

    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommentRequest  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(setting $setting, Request $request)
    {
        $address = $this->addAddress($request);
        $time = Carbon::now();

        if (Storage::exists($setting->logo)) {
            Storage::delete($setting->logo);
            Storage::deleteDirectory($time->format('Y').'/images/settings/logo');
        }
        $byte_array = $request->picture;
        $image = base64_decode($byte_array);
        Storage::put($time->format('Y').'/images/settings/logo/logo.jpg', $image);
        $picture = '/'. $time->format('Y').'/images/settings/logo/logo.jpg';

        $setting->update([
            'phone' =>  $request->phone,
            'logo' => $picture,
            'address_id' =>$address->id,
            'name' => $request->name,
            'color' => $request->color
        ]);
       $setting->admin()->update([
           'email' => $request->email,
       ]);

       if ($request->old_password !== null && $request->new_password !== null){
           if (Hash::check($request->old_password, $setting->admin->password)) {
                $setting->admin()->update([
                    'password' => Hash::make($request->new_password)
                ]);
           }else {
               return $this->returnErrorMessage('the old password does not match', 403);
           }
       }
       return $this->returnData('settings', $setting->load('admin', 'address'), 'success');

    }

  /*  public function destroy(Comment $comment)
    {
        if (Auth::id() == $comment->owner_id){
            $comment->delete();
        }else
            return response()->json(null, 403);

    }*/

}
