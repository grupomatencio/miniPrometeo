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


    private function compartirSerialNumber($serialNumber) {

        // URL API Prometeo
        $url = 'http://156.90.90.1/api/compareSerialNumber';

        // Enviamos un Post con datos
        $response = Http::post($url, [
            'key1' => $serialNumber
        ]);

        // Respusta
        if ($response->successful()) {
            return true;
        } else {
            return false;
        }

    }
}
