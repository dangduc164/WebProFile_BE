<?php

namespace App\Http\Controllers;

use App\Services\ExportPdfServices;
use Barryvdh\DomPDF\Facade\Pdf;
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
        // $html = $request->input('html');
        // $filename = $request->input('filename');


        // $pdf = $this->pdfService->generate($html);


        //   return  $pdf->download($filename);
        // return response()->json([
        //     'status' => 200,
        //     'message' => 'download success'
        // ], 200);


        set_time_limit(300);
        // Get the HTML content and filename from the request
        $html = $request->input('html');
        $filename = $request->input('filename', 'document.pdf'); // Default filename

        // Check if html and filename are provided
        if (empty($html) || empty($filename)) {
            return response()->json([
                'status' => 400,
                'message' => 'HTML content and filename are required'
            ], 400);
        }

        // Generate PDF using the provided HTML content
        $pdf = Pdf::loadHTML($html);
        dd(   $pdf->download() );

        // Return the generated PDF for download
        return $pdf->download($filename);
    }
}
