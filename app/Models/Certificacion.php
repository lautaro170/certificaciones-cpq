<?php

namespace App\Models;

use App\Enums\TipoCertificacionEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
/**
 * @Var TipoCertificacionEnum $tipo;
 */
class Certificacion extends Model
{
    protected $fillable = [
        'tipo',
        'a_nombre_de',
        'dni_cuit',
        'cosa_a_certificar',
        'fecha_emision',
        'archivos'
    ];
    protected function casts()
    {
        return [
            'uuid' => 'string',
            'fecha_emision' => 'date',
        //    'archivos' => 'array'
        ];
    }
    public static function boot(): void
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::uuid4()->toString();
        });
    }


    public function getTipoCertificadoAttribute(){
        return TipoCertificacionEnum::from($this->tipo)->nombre();
    }

}
