<?php

namespace App\Services;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\Result\ResultInterface;

class QRService
{

    public function generateWithResponse($data, $filename): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {

        $qrCode = $this->generateValidQr($data);

        $qrCodeString = $qrCode->getString();

        // Create a temporary file
        $tempFile = tempnam(sys_get_temp_dir(), 'mm') . '.png';
        file_put_contents($tempFile, $qrCodeString);

        // Return a download response
        return response()->download($tempFile, $filename)->deleteFileAfterSend(true);
    }

    public function generateValidQr($data): ResultInterface {
        return Builder::create()
            ->writer(new PngWriter())
            ->data($data)
            ->size(300)
            ->margin(10)
            ->validateResult(true)
            ->build();
    }
}
