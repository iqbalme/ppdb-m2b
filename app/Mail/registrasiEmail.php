<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PDF;

class registrasiEmail extends Mailable
{
    use Queueable, SerializesModels;
	public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		$temp_data = $this->data;
		$subjek = env('PREFIX_SUBJECT_REGISTRATION_EMAIL_ATTACHMENT', '').$temp_data["data"]["status_pendaftar"]["noRegistrasi"];
		$message = $this->view('mail.registrasiEmail')
			->subject($subjek)
			->with([
				"nama" => $temp_data["data"]['nama_lengkap'],
				"no_registrasi" => $temp_data["data"]["status_pendaftar"]["noRegistrasi"],
				"pin" => $temp_data["data"]["status_pendaftar"]["pin"],
			]);
		for($i=0;$i<count($temp_data["attachments"]);$i++){
			$message->attach(storage_path('app/'.$temp_data["attachments"][$i]));
		}
		return $message;
    }
}
