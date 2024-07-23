<?php

namespace App\Filament\Resources\CertificacionResource\Pages;

use App\Filament\Resources\CertificacionResource;
use App\Models\Certificacion;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCertificacion extends EditRecord
{
    protected static string $resource = CertificacionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\Action::make('download_qr')
                ->label("Descargar QR")
                ->url(
                    fn (Certificacion $record): string => "javascript:downloadQr('" . route('certificaciones.qr', ['certificacion' => $record]). "', '$record->a_nombre_de.png')",
                    shouldOpenInNewTab: false
                )

        ];
    }
}
