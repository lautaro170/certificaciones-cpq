<?php

namespace App\Filament\Resources;

use App\Enums\TipoCertificacionEnum;
use App\Filament\Actions\DownloadQrAction;
use App\Filament\Resources\CertificacionResource\Pages;
use App\Models\Certificacion;
use App\Services\QRService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CertificacionResource extends Resource
{
    protected static ?string $model = Certificacion::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $slug = "certificaciones";
    protected static ?string $navigationLabel = "Certificaciones";
    protected static ?string $breadcrumb = "Certificaciones";



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('tipo')
                    ->options(
                        TipoCertificacionEnum::getForSelect()
                    )
                    ->live()
                    ->required(),
                Forms\Components\TextInput::make('a_nombre_de')
                    ->required(),
                Forms\Components\TextInput::make('dni_cuit')
                    ->required(),
                Forms\Components\TextInput::make('cosa_a_certificar')
                    ->required()
                    ->label("Motivo"),
                Forms\Components\DatePicker::make('fecha_emision')
                    ->required(),
                Forms\Components\FileUpload::make('archivos')
                    ->visible(fn (Get $get) => $get('tipo') == TipoCertificacionEnum::CV->value)
                    ->directory('certificaciones')
                    ->getUploadedFileNameForStorageUsing(
                        fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                            ->prepend((string) now()->timestamp."-"),
                    )

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tipoCertificado'),
                Tables\Columns\TextColumn::make('a_nombre_de')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('dni_cuit')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('cosa_a_certificar')
                    ->label("Motivo")
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('fecha_emision')
                    ->date()
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('tipo')
                    ->options(TipoCertificacionEnum::getForSelect())
                    ->name("Tipo")

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('show')
                    ->label("Ver")
                    ->url(fn (Certificacion $record): string => route('certificacion.show', $record->uuid), true),
                Tables\Actions\Action::make('download_qr')
                    ->label("QR")
                    ->url(
                        fn (Certificacion $record): string => "javascript:downloadQr('" . route('certificaciones.qr', ['certificacion' => $record]) . "', '$record->a_nombre_de.png')",
                        shouldOpenInNewTab: false
                    )
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCertificacions::route('/'),
            'create' => Pages\CreateCertificacion::route('/create'),
            'edit' => Pages\EditCertificacion::route('/{record}/edit'),
        ];
    }
}
