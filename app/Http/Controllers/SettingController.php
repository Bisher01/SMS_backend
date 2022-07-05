<?php

namespace App\Http\Controllers;

use App\Traits\generalTrait;
use Illuminate\Http\Request;
use App\Models\setting;
use App\Models\Student;

class SettingController extends Controller
{
    use generalTrait;
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
   /* public function update(UpdateCommentRequest $request, Comment $comment)
    {
        if (Auth::id() == $comment->owner_id){
            $comment->update([
                'value'=>$request->value,
                'owner_id'=>Auth::id(),
                'product_id'=>$request->product_id,
            ]);
            return response()->json(["key"=>$comment, 200]);
        }else
            return response()->json(null, 403);

    }

  /*  public function destroy(Comment $comment)
    {
        if (Auth::id() == $comment->owner_id){
            $comment->delete();
        }else
            return response()->json(null, 403);

    }*/

}
