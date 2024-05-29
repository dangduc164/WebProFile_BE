<?php

namespace App\Http\Controllers;
use App\Services\ExportPdfServices;
use Illuminate\Http\Request;

class ExportPdfController extends Controller
{
    private $pdfService;

    public function __construct(ExportPdfServices $pdfService)
    {
        $this->pdfService = $pdfService;
    }

    public function generatePdf(Request $request)
    {
        $html = $request->input('html');
        $filename = $request->input('filename');

        $pdf = $this->pdfService->generate($html);
        return $pdf->download($filename);
    }
}
