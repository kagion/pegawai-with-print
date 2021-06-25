<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Student;
use PDF;
// use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function printId(Pegawai $pegawai)
    {
        $pdf = PDF::loadView('id-card-pdf', ["pegawais" => [$pegawai]]);
        $pdf->setPaper('A4', '');
        return $pdf->stream($pegawai->first_name . "_" . $pegawai->last_name . "-" . str_pad($pegawai->id + 1, 4, '0', STR_PAD_LEFT) . '.pdf');
    }
    public function printIdBulk()
    {
        $pdf = PDF::loadView('id-card-pdf', ["pegawais" => Pegawai::all()]);
        $pdf->setPaper('A4', '');
        return $pdf->stream('allpegawai-id.pdf');
    }
}
