<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;

use App\Http\Controllers\Datos;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LibroController;



Route::get('/', function () {

    return view('welcome');
});


Route::get('/login', function () {

    return view('welcome');
})->name('login');



Route::get('/contacto', function () {

    return "Página de contacto";
})->name('contacto');


Route::middleware(['auth'])->group(function () {
    Route::get('/admin/usuarios', function () {
    // Tu lógica aquí
    });

    Route::get('/admin/configuracion ', function () {
    // Tu lógica aquí
    });
});



Route::post('/procesar-datos', [Datos::class, 'procesar']);



Route::get('/procesar-datos', [Datos::class, 'procesar']);


Route::get('/usuario', [UsuarioController::class, 'index']);
//Route::get('/usuario/{id}', [UsuarioController::class, 'show'])->name('usuario.show');


Route::get('/usuario/store', [UsuarioController::class, 'store'])->name('usuario.store');



Route::get('/libro', [LibroController::class, 'index'])->name('libro.index');
Route::get('/libro/alta', [LibroController::class, 'create'])->name('libro.create');
Route::post('/libro/alta', [LibroController::class, 'create'])->name('libro.create');