<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function generatePDF()
    {
        $data = ['title' => 'Prueba de DOMPDF Laravel 10'];
        $pdf = Pdf::loadView('pdf.documentos.memo',$data);
        return $pdf->download('documento.pdf');
    }
}
