<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use PDF;

class suratPernyataanController extends Controller
{
    public function suratPernyataanSiswa(Request $request){
		//return view('suratPernyataanSiswa');
		//die;
		
        //return $pdf->stream();
		$data["email"]= 'webcracking@gmail.com';
        $data["nama"]= 'Muhammad Iqbal';
        $data["subject"]= 'tes kirim email';

        $pdf = PDF::loadView('suratPernyataanSiswa', $data)->setPaper('A4', 'portrait')->setWarnings(false);
		try{
		Mail::send('testemail', $data, function($message)use($data,$pdf) {
			$message->to($data["email"], $data["nama"])
			->subject($data["subject"])
			->attachData($pdf->output(), "surat_pernyataan.pdf");
		});
		} catch(Exception $e){
			$this->error = $e;
		}
        if (Mail::failures()) {
             $this->statusdesc  =   "Error sending mail";
             $this->statuscode  =   "0";
        }else{
           $this->statusdesc  =   "Message sent Succesfully";
           $this->statuscode  =   "1";
        }
        return response()->json(compact('this'));
	}
	
	public function suratPernyataanWali(Request $request){
		return view('suratPernyataanWali');
		die;
		$pdf = PDF::loadView('suratPernyataanWali')->setPaper('A4', 'portrait')->setWarnings(false);
        return $pdf->stream();
	}
}
