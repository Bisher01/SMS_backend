<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\Blood;
use App\Models\Claass;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\Nationality;
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
        $nationality = Nationality::query()->get();

        $data[] = $bloods;
        $data[] = $classes;
        $data[] = $genders;
        $data[] = $grades;
        $data[] = $religtions;
        $data[] = $nationality;

        return $this->returnData('data', $data, 'all seed');

    }
}
