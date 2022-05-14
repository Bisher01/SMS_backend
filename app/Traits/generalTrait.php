<?php
namespace App\Traits;

trait generalTrait{
public function returnError($errNum, $msg)
{
    return response()->json([
        'status'=>false,
        'errNum'=>$errNum,
        'msg'=>$msg
    ]);
}

public function returnSuccess($errNum, $msg)
{
    return response()->json([
        'status'=>true,
        'errNum'=>$errNum,
        'msg'=>$msg
    ]);
}
public function returnData($key, $value)
{
    return response()->json([
        'status'=>true,
        'errNum'=>"success",
        $key=>  $value  ]);
}
}









