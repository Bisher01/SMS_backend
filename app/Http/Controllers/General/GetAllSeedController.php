<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\Blood;
use App\Models\Claass;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\Religtion;
use App\Traits\generalTrait;
use Illuminate\Http\Request;

class GetAllSeedController extends Controller
{
    use generalTrait;
    public function getAllSeed() {
        $bloods = Blood::query()->get();
        $classes = Claass::query()->get();
        $genders = Gender::query()->get();
        $grades = Grade::query()->get();
        $religtions = Religtion::query()->get();

        $data['bloods'] = $bloods;
        $data['classes'] = $classes;
        $data['genders'] = $genders;
        $data['grades'] = $grades;
        $data['religtions'] = $religtions;

        return $this->returnData('data', $data, 'all seed');

    }
}
