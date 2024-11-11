<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PedirAyudaController;
use App\Http\Controllers\MachineController;


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

Route::get('/welcome', function() {
    return view('welcome');
})->name('welcome');


Route::get('/machines', [MachineController::class, 'index'])->name('machines');
Route::get('machines/delegation/{id}', [MachineController::class, 'create'])->name('machineDelegation.create');
// Route::resource('machines', MachineController::class);
