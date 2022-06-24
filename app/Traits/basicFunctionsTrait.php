<?php
namespace App\Traits;

use App\Models\Address;
use App\Models\Blood;


trait basicFunctionsTrait{
    use generalTrait;
    public function addAddress($request) {
        $address = Address::query()->create([
            'city' => $request->city,
            'street' => $request->street,
            'town' => $request->town,
        ]);
        return $address;
    }
    public function getBloods() {
        $bloods = Blood::query()->get();
        return $bloods;
    }
}
