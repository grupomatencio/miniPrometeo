<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Local;
use App\Models\Zone;
use App\Models\Delegation;


class ConfiguracionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_cambio = User::where('name','ccm') -> first();
        $user_comDataHost = User::where('name','admin') -> first();
        $locales = Local::all();
        $zones=Zone::all();
        $delegation = Delegation::where('name', 'Benidorm') -> first();

        $data = [
            'user_cambio' => $user_cambio,
            'user_comDataHost' => $user_comDataHost,
            'locales' => $locales,
            'zones' => $zones,
            'delegation' => $delegation
        ];

        return view('configuracion.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'ip_cambio' => ['required', 'ipv4'],
            'port_cambio' => ['required', 'numeric', 'max:10001'],
            'ip_comdatahost' => ['required', 'ipv4'],
            'port_comdatahost' => ['required', 'numeric', 'max:10001'],
            'locales' => ['required'],
            'zones' => ['required']
        ], [
            'ip_cambio.required' => 'Este campo es obligatorio.',
            'port_cambio.required' => 'Este campo es obligatorio.',
            'ip_comdatahost.required' => 'Este campo es obligatorio.',
            'port_comdatahost.required' => 'Este campo es obligatorio.',
            'ip_cambio.ipv4' => 'En este campo solo IP',
            'ip_comdatahost.ipv4' => 'En este campo solo IP',
            'port_cambio.numeric' => 'En    este campo solo digitos',
            'port_cambio.min' => 'Numero de puerto muy grande',
            'port_comdatahost.numeric' => 'En este campo solo digitos',
            'port_comdatahost.min' => 'Numero de puerto muy grande',
            'locales.required' => 'Este campo es obligatorio.',
            'zones.required' => 'Este campo es obligatorio.'
        ]);

        $data = $request-> except ('_token');
        User::where('name','ccm') -> update ([
            'ip' => $data['ip_cambio'],
            'port' => $data['port_cambio']
        ]);
        User::where('name','admin') -> update ([
            'ip' => $data['ip_comdatahost'],
            'port' => $data['port_comdatahost']
        ]);

        $local = Local::find($data['locales']);
        if($local) {
            Local::truncate();
            $local ->replicate() -> save();
        }


        $zone = Zone::find($data['zones']);
        if($zone) {
            Zone::query() -> delete ();
            $zone ->replicate() -> save();
        }


        return redirect()->route('configuracion.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_cambio = User::where('name','ccm') -> first();
        $user_cambio ->ip = null;
        $user_cambio ->port = null;
        $user_cambio -> save();

        $user_comDataHost = User::where('name','admin') -> first();
        $user_comDataHost ->ip = null;
        $user_comDataHost ->port = null;
        $user_comDataHost -> save();

        return view('configuracion.index', compact('user_cambio','user_comDataHost' ));
    }

    public function buscar() {
        $user_cambio = User::where('name','ccm') -> first();

        $filePath = 'C:\Gistra\SMI2000\Setup-TicketController\preferences.cfg';

        if (file_exists($filePath)) {


            $fileContent = file_get_contents($filePath);

            if(preg_match('/<ServerIP>(.*?)<\/ServerIP>/', $fileContent, $matches)) {
                $user_cambio ->ip = $matches[1];
            } else {
                $user_cambio ->ip = '0.0.0.0';
            }

            if(preg_match('/<ServerPort>(.*?)<\/ServerPort>/', $fileContent, $matches)) {
                $user_cambio ->port = $matches[1];
            } else {
                $user_cambio ->port = '';
            }
        }

        $user_comDataHost = new User;
        $user_comDataHost ->ip = $this -> getLocalIp ();
        $user_comDataHost ->port = 3506;

        return view('configuracion.index', compact('user_cambio','user_comDataHost' ));
    }

    private function getLocalIp () {

        $output = shell_exec('ipconfig');

        if (preg_match('/IPv4.*?:\s*([0-9.]+)/', $output, $matches)) {
            $localIp = $matches[1];
        }
        return $localIp;
    }
}
