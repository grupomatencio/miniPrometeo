<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PedirAyudaController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', function () {
    $error = session()->get('error');
    if (Auth::check()) {
        return redirect()->route('home')->with('error', $error);
    }
    return redirect('/login');
});

Route::get('/home', function () {
    return view('home');
})->name('home')->middleware(['auth', 'check.processor']);

Route::post('/pedir_ayuda', [PedirAyudaController::class, 'sendMessage'])->name('pedir.ayuda');

Route::get('/machines1', function() {
    return view('machines.index1');
})->name('machine1.index');


Route::get('/machines', function() {
    return view('machines.index');
})->name('machines.index');
