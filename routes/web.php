<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;

use App\Http\Controllers\Datos;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LibroController;

use App\Http\Controllers\SocioController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/admin', function () {
return view('admin.dashboard');
})->middleware('auth');



Route::post('/procesar-datos', [Datos::class, 'procesar']);



Route::get('/procesar-datos', [Datos::class, 'procesar']);


Route::get('/usuario', [UsuarioController::class, 'index']);
//Route::get('/usuario/{id}', [UsuarioController::class, 'show'])->name('usuario.show');


Route::get('/usuario/store', [UsuarioController::class, 'store'])->name('usuario.store');



Route::get('/libro', [LibroController::class, 'index'])->name('libro.index');
Route::get('/libro/create', [LibroController::class, 'create'])->name('libro.create');
Route::post('/libro/create', [LibroController::class, 'create'])->name('libro.create');

Route::get('/libro/edit/{i}', [LibroController::class, 'edit'])->name('libro.edit');
Route::post('/libro/edit', [LibroController::class, 'edit'])->name('libro.edit');

Route::get('/libro/show/{i}', [LibroController::class, 'show'])->name('libro.show');


Route::get('/libro/destroy/{i}', [LibroController::class, 'destroy'])->name('libro.destroy');
Route::post('/libro/destroy', [LibroController::class, 'destroy'])->name('libro.destroy');





// RUTAS SOCIOS 
Route::get('/socio', [LibroController::class, 'index'])->name('socio.index');
Route::get('/socio', [SocioController::class, 'index'])->name('socio.index');
// Create
Route::get('/socio/create', [SocioController::class, 'create'])->name('socio.create');
Route::post('/socio/create', [SocioController::class, 'create'])->name('socio.create');
// Edit
Route::get('/socio/edit/{id}', [SocioController::class, 'edit'])->name('socio.edit');
Route::post('/socio/edit', [SocioController::class, 'edit'])->name('socio.edit');

// Show
Route::get('/socio/show/{id}', [SocioController::class, 'show'])->name('socio.show');

// Destroy
Route::get('/socio/destroy/{id}', [SocioController::class, 'destroy'])->name('socio.destroy');
Route::post('/socio/destroy', [SocioController::class, 'destroy'])->name('socio.destroy'); // <--- El {id} aquí es vital