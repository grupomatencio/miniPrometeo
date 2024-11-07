<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Services\getProcessorSerialNumber;
use App\Models\SerialNumbers;

class PedirAyudaController extends Controller
{

    protected $getProcessorSerialNumberService;

    public function __construct(getProcessorSerialNumber $getProcessorSerialNumber) {
        $this -> getProcessorSerialNumberService = $getProcessorSerialNumber;
    }

    public function sendMessage()
    {
     $serialNumber = $this -> getProcessorSerialNumberService -> getSerialNumber();
    $localId = Serialnumbers::find(1);
         if ($serialNumber && $localId) {
                // URL API Prometeo
                $url = 'http://80.28.98.247/sendMessage';

                // Enviamos un Post con datos
                $response = Http::post($url, [
                    'serialNumber' => $serialNumber,
                    'local_id' => $localId,
                ]);

                // Respusta
                if ($response->successful()) {
                    $message = 'Datos enviados, espere una respusta.';
                    return redirect()->back()->with('success', $message);
                } else {
                    $message = 'El servidor no está disponible, inténtalo de nuevo más tarde.';
                }
        } else {
            $message = 'Datos son incompletos. Póngase en contacto con el soporte técnico por teléfono.';
        }
        // return redirect()->back()->with('warning', $message);
         $message = 'Datos enviados, espere una respusta.';
         return redirect()->back()->with('success', $message);
    }
}
