<?php

namespace App\Http\Controllers;

use App\Enums\TipoCertificacionEnum;
use App\Models\Certificacion;
use App\Services\QRService;
use Illuminate\Support\Facades\Storage;

class CertificacionController extends Controller
{
    public function show($uuid)
    {
        $certificacion = Certificacion::where('uuid', $uuid)->firstOrFail();


        if($certificacion->tipo == TipoCertificacionEnum::CV->value){
            $urlDocumentoCertificado = Storage::disk('public')->url($certificacion->archivos);
        }

        return view('certificacion', [
            'certificacion' => $certificacion,
            'urlDocumentoCertificado' => $urlDocumentoCertificado ?? ''
        ]);
    }


    public function getQr(Certificacion $certificacion, QRService $QRService){

        return $QRService->generateWithResponse(route('certificacion.show', $certificacion->uuid), "$certificacion->a_nombre_de.png");
    }
}
