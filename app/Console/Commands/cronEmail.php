<?php

namespace App\Console\Commands;

use App\EmailSent;
use App\EmailToSend;
use App\Mail\registrasiEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Console\Command;

class cronEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending email after registration';
	protected $prefix_path;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
		$this->prefix_path = "public/attachment/";
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
		$to_send = EmailToSend::all();
		foreach ($to_send as $items) { //begin looping
			$data = json_decode($items['data']);
			$attachments = [
				$this->prefix_path.'Kartu_Registrasi_No_'.$data->status_pendaftar->noRegistrasi.'.pdf',
				$this->prefix_path.'Surat_Pernyataan_Siswa_NoRegistrasi_'.$data->status_pendaftar->noRegistrasi.'.pdf',
				$this->prefix_path.'Surat_Pernyataan_Wali_NoRegistrasi_'.$data->status_pendaftar->noRegistrasi.'.pdf'
			];
			$object_to_send = [
				'data' => $data,
				'attachments' => $attachments
			];
			try{
				Mail::to($items->email)->send(new registrasiEmail($object_to_send));
				EmailSent::create([
					'pendaftar_id' => $data->id,
					'email' => $items->email
				]);
				$items->delete();
				//return 'success';
			} catch(Exception $e){
				//return 'error';
			}	
		} //end looping
		
					
		// $sending_email = $this->kirimAttachment($new_data, $attachments);
		// if($sending_email == 'success'){
			// return response()->json(['status' => 'success']);
		// } else {
			// return response()->json(['status' => 'error']);
		// }
    }
}
