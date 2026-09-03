<?php

use App\Http\Controllers\AtividadeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('atividade.index');
});
Route::get('/atividades/feed', [AtividadeController::class, 'feedCalendario']);
Route::resource('atividades', AtividadeController::class);
