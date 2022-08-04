<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Syllabi;
use App\Traits\basicFunctionsTrait;
use App\Traits\generalTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckSyllabi extends Controller
{
    use generalTrait, basicFunctionsTrait;

    public function getAllSyllabi() {
        $syllabi = DB::table('syllabi')->get();
        return $this->returnAllData('data', $syllabi, 'success');
    }

    public function acceptSyllabi(Syllabi $syllabi) {
        if ($syllabi->active) {
            $syllabi->update([
                'active' => 0
            ]);
            return $this->returnSuccessMessage('inactive');
        }else {
            $syllabi->update([
                'active' => 1
            ]);
            return $this->returnSuccessMessage('active');
        }

    }
}