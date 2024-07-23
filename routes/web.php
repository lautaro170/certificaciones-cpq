<?php

use App\Http\Controllers\CertificacionController;
use Illuminate\Support\Facades\Route;


Route::get('/certificaciones/{uuid}', [CertificacionController::class, "show"])->name('certificacion.show');

Route::get('/admin/certificaciones/{certificacion}/qr', [CertificacionController::class, "getQr"])->name('certificaciones.qr');

Route::get('/', function () {
    return redirect('/admin');
});
