<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Machine;
use App\Models\MachinePrometeo;

class ImportController extends Controller
{


    public function index()
    {
        try {

            $machines = Machine::all();
            $machines_prometeo = collect();
            $importBD = false;        // Si no habia importacion - false
            $message = "";              // Mensaje de informacion de servicio
            // $machines_prometeo = MachinePrometeo::all();

            $diferencia = []; // Deferncia entre $machines & $machines_prometeo
            if ($machines_prometeo -> isNotEmpty()) {
                $diferencia = $this -> comparar($machines, $machines_prometeo);
            }

            return view("import.index", ["machines" => $machines,
                                                     "machines_prometeo" => $machines_prometeo,
                                                     "importBD" => $importBD,
                                                     "message" => $message,
                                                     "diferencia" => $diferencia]);
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    public function store()
    {

        try {
            $machines_prometeo = MachinePrometeo::all();
            $machines_prometeo_array = $machines_prometeo->toArray();


            Machine::truncate();


            foreach ($machines_prometeo_array as $machine) {
                try {
                    // $machine->timestamps = false;
                    Machine::create($machine);
                } catch (\Exception $e) {
                    dd($e -> getMessage());
                }
            }

            $machines = Machine::all();
            $importBD = true;        // hay importacion - true
            $message = "La importacion de datos se ha realizado correctamente.";              // Mensaje de informacion de servicio
            $diferencia = [];

            return view("import.index", ["machines" => $machines,
                            "machines_prometeo" => $machines_prometeo,
                            "importBD" => $importBD,
                            "message" => $message,
                            "diferencia" => $diferencia]);

        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }

    }

    private function comparar ($machines, $machines_prometeo) {
        $identificadoresMachine = $machines -> pluck ('identificador');
        $identificadoresMachinePrometeo = $machines_prometeo -> pluck ('identificador');

        $diferencia = $identificadoresMachine -> diff($identificadoresMachinePrometeo);

        $diff = $diferencia -> values() ->toArray ();

        return $diff;
    }

}
