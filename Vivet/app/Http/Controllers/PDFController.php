<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Appointment;

class PDFController extends Controller
{
    public function appointmentsReport()
    {
        // Traemos las citas con sus relaciones
        $appointments = Appointment::with(['pet', 'vet', 'pet.client'])
            ->orderBy('appointment_date', 'desc')
            ->get();

        // Generamos el PDF usando la vista Blade
        $pdf = Pdf::loadView('tenant.pdf.reports.appointments', compact('appointments'));

        return $pdf->stream('reporte_citas.pdf');
    }
}
