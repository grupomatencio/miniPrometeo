<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CheckProcessorSerial
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $serialNumber = $this -> getProcessorSerialNumber();
        if ($serialNumber) {
            $respustaServidor = $this -> compartirSerialNumber($serialNumber);
            if($respustaServidor){
                session() -> flash('error',$serialNumber);
                Log::info('Todo bien');
                Log::info($serialNumber);
            } else {
                $errorMessage = 'Serial Number es icorrecto';
                session() -> flash('error',$errorMessage);
                Log::info('error de comparacion');

            }

        }
        return $next($request);
    }


    private function getProcessorSerialNumber()
{
    // Para Windows
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        $serial = shell_exec('wmic cpu get ProcessorId');
        log::info('win');
        log::info($serial);
        return trim(preg_replace('/\s+/', ' ', $serial)); // Убираем лишние пробелы
    }

    // Para Linux
    elseif (strtoupper(substr(PHP_OS, 0, 6)) === 'LINUX') {
        $output = "ID: C1 06 08 00 FF FB EB BF";  //shell_exec('sudo /usr/sbin/dmidecode -t 4 | grep ID');

        if ($output) {
            // Извлекаем полный ID из вывода команды с учетом пробелов
            preg_match('/ID:\s*([a-fA-F0-9\s]+)/', $output, $matches);
            $serial = isset($matches[1]) ? trim($matches[1]) : null;
        } else {
            $serial = null;
        }+
        Log::info('lin');
        log::info($serial);
        return trim($serial);
    }

    return null; // Si hay otro
    }



    private function compartirSerialNumber($serialNumber) {

    // URL API Prometeo
    $url = 'https://';

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
