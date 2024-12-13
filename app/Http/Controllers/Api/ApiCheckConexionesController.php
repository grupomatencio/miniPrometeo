<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Local;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ApiCheckConexionesController extends Controller
{
    public function index () {

        $url = 'http://192.168.1.41:8000/api/checkConexion';   // Probar conexiones con prometeo
        $conPrometeo = Http::get($url);

        $local = Local::first();
        $localID = $local -> id;

        $conexionConTicketServer = nuevaConexionLocal('ccm');

        Log::info($conexionConTicketServer);

        try {
            DB::connection($conexionConTicketServer) -> getDatabaseName();
            $conTS = true;
        } catch (\Exception $e) {
            Log::info($e);
            $conTS = false;
        }



        if ($conTS) {

        return $conTS;
        }
    }

}
