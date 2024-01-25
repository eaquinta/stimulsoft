<?php

namespace App\Http\Controllers\Test;

use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PDFController extends Controller
{
    public function generatePDF()
    {
        $users = User::get();

        $data = [
            'title' => 'Test',
            'date' => date('m/d/Y'),
            'users' => $users
        ];

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('test.myPDF', $data);
        //return $pdf->stream('test.pdf');
        return $pdf->download('test.pdf');
    }
}
