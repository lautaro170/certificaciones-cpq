<?php

namespace App\Filament\Actions;

use App\Models\Certificacion;
use App\Services\QRService;
use Filament\Tables\Actions\Action;
use Illuminate\Http\Request;

class DownloadQrAction extends Action
{
    public function handle(Request $request, Certificacion $record)
    {
        $qrService = app(QRService::class);
        return $qrService->generateWithResponse(route('certificacion.show', $record->uuid))->download();
    }
}
