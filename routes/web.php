<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocioController;
use App\Http\Controllers\AsistenteController;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\ClasesController;
use App\Http\Controllers\RutinaController;
use App\Http\Controllers\SuscripcionController;
use App\Http\Controllers\ClaseSocioController;


use Illuminate\Support\Facades\Route;

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

    Route::resource('/socios', SocioController::class);
    Route::resource('/socios/{id}/edit', SocioController::class);
    Route::resource('socios', SocioController::class);
    Route::get('/socios/create', [SocioController::class, 'create'])->name('socios.create');

    Route::resource('/asistentes', AsistenteController::class);
    Route::get('/asistentes/create', [AsistenteController::class, 'create'])->name('asistentes.create');
    Route::resource('/asistentes/{id}/edit', SocioController::class);

    Route::resource('/actividades', ActividadController::class);

    Route::resource('/clases', ClasesController::class);

    Route::resource('/rutinas', RutinaController::class);

    Route::resource('suscripciones', SuscripcionController::class)->parameters([
        'suscripciones' => 'suscripcion',
    ]);

    //Route::resource('clasesocios', ClaseSocioController::class)->parameters([
    //    'clasesocios' => 'clasesocio',
    //]);
    Route::resource('/clasesocios', ClaseSocioController::class);

    

});

require __DIR__.'/auth.php';
