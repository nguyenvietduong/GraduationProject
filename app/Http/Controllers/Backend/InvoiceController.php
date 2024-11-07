<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function generatePDF()
    {
        $pdf = Pdf::loadView('backend.reservation.invoice_pdf');
        return $pdf->stream('invoice.pdf');
    }
}
