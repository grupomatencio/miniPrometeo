<?php

use App\Models\Local;
use App\Models\Zone;
use App\Models\User;
use App\Models\Delegation;
use App\Models\lastUserMcDate;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;



function nuevaConexion($local)
{
    $localDate = Local::find($local);
    $connectionName = 'mariadb';

    // Decodificar el JSON de la conexión y obtener la primera conexión (índice 0)
    $datosConexion = json_decode($localDate->dbconection);

    $conexionCero = $datosConexion[0];  // Asegúrate de que el JSON sea un array y accede al primer elemento

    // Modificar la configuración de la conexión de base de datos
    config([
        'database.connections.' . $connectionName . '.host' => $conexionCero->ip,
        'database.connections.' . $connectionName . '.port' => $conexionCero->port,
        'database.connections.' . $connectionName . '.database' => $conexionCero->database,
        'database.connections.' . $connectionName . '.username' => $conexionCero->username,
        'database.connections.' . $connectionName . '.password' => $conexionCero->password,

    ]);

    // Limpiar la conexión para que se apliquen los nuevos valores
    DB::purge($connectionName);

    return $connectionName;
}

//


// conexion depende de nombre usuario
function nuevaConexionLocal($name)
{
    $user = User::where('name', $name) ->first();
    $connectionName = 'mariadb'. '-'. $name;

    if ($name = 'admin') {
        $database = 'ticketserver';
    } else {
        $database = "comdata";
    }

    // Log::info($database);


    // Modificar la configuración de la conexión de base de datos
    config([
        'database.connections.' . $connectionName . '.host' => $user->ip,
        'database.connections.' . $connectionName . '.port' => $user->port,
        'database.connections.' . $connectionName . '.database' => $database,
        'database.connections.' . $connectionName . '.username' => $user->name,
        'database.connections.' . $connectionName . '.password' => $user->password,
        'database.connections.' . $connectionName . '.driver' => 'mysql',
    ]);

    // Limpiar la conexión para que se apliquen los nuevos valores
    DB::purge($connectionName);

    return $connectionName;
}



function getSerialNumber() :string
{
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        $serial = shell_exec('wmic cpu get ProcessorId');

        // Limpiar el serial eliminando saltos de línea y espacios extra
        $serial = preg_replace('/\s+/', ' ', trim($serial));

        // Explodemos el serial por el espacio para obtener la parte deseada
        $parts = explode(' ', $serial);

        // Extraemos el primer valor que debería ser el ProcessorId
        $processorId = $parts[1]; // Asumiendo que el ProcessorId es el segundo elemento

        return $processorId;
    }

    // Para Linux
    elseif (strtoupper(substr(PHP_OS, 0, 6)) === 'LINUX') {
        $output = "ID: C1 06 08 00 FF FB EB BF";  // solo para probar
        //shell_exec('sudo /usr/sbin/dmidecode -t 4 | grep ID');

        if ($output) {
            preg_match('/ID:\s*([a-fA-F0-9\s]+)/', $output, $matches);
            $serial = isset($matches[1]) ? trim($matches[1]) : null;
        } else {
            $serial = null;
        }
        return trim($serial);
    }

    return null; // Si hay otro
}

    // Para obtener datos de local, zona, delegation
    function getDisposicion () {
        $locales = Local::all();
        $zones=Zone::all();
        $delegation = Delegation::all();
        $name_zona = "";
        $name_delegation = "";

        if (count($zones) == 1) {
            $name_zona = $zones[0] -> name;
        }

        if (count($delegation) == 1) {
            $name_delegation = $delegation[0] ->name;
        }

        return $disposicion = [
            'locales' => $locales,
            'name_zona' =>  $name_zona,
            'name_delegation' => $name_delegation
        ];
    }

