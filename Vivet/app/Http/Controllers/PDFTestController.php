<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;

class PDFTestController extends Controller
{
    public function testPDF()
    {
        $pdf = Pdf::loadHTML('<h1>Hola mundo PDF</h1>');
        return $pdf->download('prueba.pdf');
    }
}
