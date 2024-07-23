<?php

namespace App\Enums;

enum TipoCertificacionEnum: string{
    case CURSOS = "certificacion-cursos";
    case ESPECIALIDAD = "certificacion-especialidad";
    case HABILITACION_LABORATORIOS = "certificacion-habilitacion-laboratorios";
    case CV = "certificacion-cv";

    public function nombre(): string{
        return match($this){
            self::CURSOS => "Cursos",
            self::ESPECIALIDAD => "Especialidad",
            self::HABILITACION_LABORATORIOS => "Habilitación de Laboratorios",
            self::CV => "CV",
        };
    }

    public function titulo():string{
        return match($this){
            self::CURSOS => "Certificado de Curso",
            self::ESPECIALIDAD => "Certificado de Especialidad",
            self::HABILITACION_LABORATORIOS => "Certificado de Habilitación de Laboratorio",
            self::CV => "Certificado de CV",
        };
    }

    public static function getForSelect(): array{
        $array = [];
        foreach(self::cases() as $tipoCertificadoEnum){
            $array[$tipoCertificadoEnum->value] = $tipoCertificadoEnum->nombre();
        }
        return $array;
    }
}
