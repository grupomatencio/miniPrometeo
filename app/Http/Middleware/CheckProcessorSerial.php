<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use App\Services\getProcessorSerialNumber;

class CheckProcessorSerial
{

    protected $getProcessorSerialNumberService;

    public function __construct(getProcessorSerialNumber $getProcessorSerialNumber) {
        $this -> getProcessorSerialNumberService = $getProcessorSerialNumber;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $serialNumber = $this -> getProcessorSerialNumberService -> getSerialNumber();
        log::info($serialNumber);
        if ($serialNumber) {
            $respustaServidor = $this -> compartirSerialNumber($serialNumber);
            // $respustaServidor = true;  // - Para comprobar
            if($respustaServidor){
                session() -> flash('error',$serialNumber);
                Log::info('Todo bien');
                Log::info($serialNumber);
            } else {
                $errorMessage = 'Serial Number es icorrecto';
                session() -> flash('error',$errorMessage);
                Log::info('error de comparacion');
                return response() -> view('permission.index');

            }

        }
        return $next($request);
    }


    /*private function compartirSerialNumber($serialNumber) {


        // URL API Prometeo
        $url = 'http://192.168.1.182/api/index';


        log::info('middle');
        log::info($serialNumber);
        // Enviamos un Post con datos
        /* $response = Http::post($url, [
            'key1' => $serialNumber
        ]);

        $response = Http::get($url);

        log::info('middle');
        log::info($response);

        // Respusta
        if ($response->successful()) {
            return true;
        } else {
            return false;
        }

    }*/

    private function compartirSerialNumber($serialNumber) {
        // URL API Prometeo
        $url = 'http://192.168.1.182/api/index';
        log::info('Enviando solicitud a la API: ' . $url);

        // Enviamos un GET
        $response = Http::get($url);

        // Registra el código de estado y el cuerpo de la respuesta
        log::info('Código de estado de la respuesta: ' . $response->status());
        log::info('Cuerpo de la respuesta: ' . $response->body());

        // Verifica si la respuesta fue exitosa
        if ($response->successful()) {
            return true;
        } else {
            return false;
        }
    }
}
