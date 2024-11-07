<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SerialNumbers;
use Illuminate\Support\Facades\Log;

class ApiControllerGetSerialNumber extends Controller
{
    public function compararSerialNumber (Request $request) {
        $serialNumber = $request -> input('serialNumber');
        log::info($serialNumber);


        $findSerialNumber = SerialNumbers::findOrFile() -> where('serialnumber', $serialNumber );

        if ($findSerialNumber) {
            return true;
        } else {
            return false;
        }
    }
}
