<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;

class ExportPdfServices
{
    public function generate($html)
    {
        $pdf =  Pdf::loadHTML($html);
        return $pdf;
    }
}
