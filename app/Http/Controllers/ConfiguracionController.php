<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ConfiguracionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('name','admin') -> first();

        if (empty($user ->ip_comdatahost)) {
            $user ->ip_comdatahost = $this -> getLocalIp ();
        }

        if (empty($user ->port_cambio)) {
            $user ->port_cambio = 3080;
        }

        return view('configuracion.index', compact('user'));
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
        ], [
            'ip_cambio.required' => 'Este campo es obligatorio.',
            'port_cambio.required' => 'Este campo es obligatorio.',
            'ip_comdatahost.required' => 'Este campo es obligatorio.',
            'port_comdatahost.required' => 'Este campo es obligatorio.',
            'ip_cambio.ipv4' => 'En este campo solo IP',
            'ip_comdatahost.ipv4' => 'En este campo solo IP',
            'port_cambio.numeric' => 'En este campo solo digitos',
            'port_cambio.min' => 'Numero de puerto muy grande',
            'port_comdatahost.numeric' => 'En este campo solo digitos',
            'port_comdatahost.min' => 'Numero de puerto muy grande',
        ]);

        $data = $request-> except ('_token');
        User::findOrFail($id) -> update ($data);

        $user = User::findOrFail($id);

        return view('configuracion.index', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('name','admin') -> first();

        $user ->ip_cambio = null;
        $user ->port_cambio = null;
        $user ->ip_comdatahost = null;
        $user ->port_comdatahost = null;

        $user -> save ();

        return view('configuracion.index', compact('user'));
    }

    public function buscar() {
        $user = User::where('name','admin') -> first();
        $filePath = 'C:\Gistra\SMI2000\Setup-TicketController\preferences.cfg';


        if (file_exists($filePath)) {


            $fileContent = file_get_contents($filePath);

            if(preg_match('/<ServerIP>(.*?)<\/ServerIP>/', $fileContent, $matches)) {
                $user ->ip_cambio = $matches[1];
            } else {
                $user ->ip_cambio = '0.0.0.0';
            }
        }

        // dd(' ');

        if (empty($user ->ip_comdatahost)) {
            $user ->ip_comdatahost = $this -> getLocalIp ();
        }

        if (empty($user ->port_cambio)) {
            $user ->port_cambio = 3080;
        }

        return view('configuracion.index', compact('user'));
    }

    private function getLocalIp () {

        $output = shell_exec('ipconfig');

        if (preg_match('/IPv4.*?:\s*([0-9.]+)/', $output, $matches)) {
            $localIp = $matches[1];
        }
        return $localIp;
    }
}
