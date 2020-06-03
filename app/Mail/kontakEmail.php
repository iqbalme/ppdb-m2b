<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class kontakEmail extends Mailable
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
        return $this->subject($this->data['subjek'])
					->view('mail.kontakEmail')
					->with(
                    [
                        'nama_pengirim' => $this->data['nama_pengirim'],
						//'subjek' => $this->data['subjek'],
						'email' => $this->data['email'],
						'konten' => $this->data['konten'],
                    ]);
    }
}
