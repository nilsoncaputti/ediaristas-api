<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Diarista\ObtemDiaristaPorCep;

Route::get('/diaristas/localidades', ObtemDiaristaPorCep::class)->name('diaristas.busca_por_cep');
