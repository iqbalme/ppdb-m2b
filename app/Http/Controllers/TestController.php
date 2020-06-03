<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;
use Illuminate\Http\Request;
use PDF;
use App\Pendaftar;
use App\PendaftarKelas;

class TestController extends Controller
{
    public function kirim_email(){
		Mail::to("webcracking@gmail.com")->send(new TestEmail());
		return "Email telah dikirim";
	}
	
	public function pendaftar(){
		$pendaftar = Pendaftar::find(7)->first();
		return response()->json($pendaftar->with(['pendaftar_kelas.kelas'])->first());
	}
	
	public function teskartu(){
		return view('kartuPendaftaran');
		die;
		$pdf = PDF::loadView('kartuPendaftaran')->setPaper('A4', 'portrait')->setWarnings(false);
        return $pdf->stream();
		// $pdf = \PDF::loadView('kartuPendaftaran');
        // $pdf->setOption('enable-javascript', true);
        // $pdf->setOption('javascript-delay', 5000);
        // $pdf->setOption('enable-smart-shrinking', true);
        // $pdf->setOption('no-stop-slow-scripts', true);
        //return $pdf->download('graph.pdf');
		// return $pdf->stream();
	}
}
