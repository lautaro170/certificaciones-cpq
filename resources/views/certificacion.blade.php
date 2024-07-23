<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación Certificado</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            height: 100vh;
            margin: 0;
        }
        .certificate-container {
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: left;
        }
        .header-logos {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-bottom: 20px;
        }
        .header-logos img {
            height: 64px;
            border: 1px solid #a6a6a6;
            border-radius: 10px;
        }
        .certification-info {
            background-color: #e1f0ff;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .certification-info p {
            margin: 0;
            font-size: 16px;
            color: #333;
        }
        .certificate-title {
            background-color: #f7f7f7;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .certificate-details {
            text-align: left;
        }
        .certificate-details p {
            margin: 5px 0;
        }
        .certificate-details span {
            font-weight: bold;
            color: #007bff;
        }

        .download-documento-certificado{
            margin:20px;
            text-align:center;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            display: block;
        }

        .download-documento-certificado:hover{
            background-color: #0056b3;
        }


    </style>
</head>
<body>
<div class="certificate-container">
    <div class="header-logos">
        <img src="/imagenes/logo-cpq.png" alt="Consejo Profesional de Química">
        <img src="/imagenes/logo-fqa.jpg" alt="Fundación Química Argentina">
    </div>
    <div class="certification-info">
        <p><strong>Documento certificado por:</strong> Fundación Química Argentina y el Consejo Profesional de Química de la Provincia de Buenos Aires.</p>
    </div>
    <div class="certificate-title">
        Certificado de {{$certificacion->tipoCertificado}}
    </div>
    <div class="certificate-details">
        <p><span>Perteneciente:</span> {{$certificacion->a_nombre_de}}</p>
        <p><span>Identidad:</span> {{$certificacion->dni_cuit}}</p>
        <p><span>Motivo:</span> {{$certificacion->cosa_a_certificar}}</p>
        <p><span>Fecha de emisión:</span> {{$certificacion->fecha_emision->isoFormat('DD/MM/YYYY')}}</p>
    </div>
</div>

@if($certificacion->tipo == \App\Enums\TipoCertificacionEnum::CV->value)
    <a class="download-documento-certificado" href="{{$urlDocumentoCertificado}}" target="_blank">
    Click para ver el documento certificado
    </a>

@endif
</body>
</html>
