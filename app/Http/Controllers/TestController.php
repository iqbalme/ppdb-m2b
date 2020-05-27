<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function kirim_email(){
		Mail::to("webcracking@gmail.com")->send(new TestEmail());
		return "Email telah dikirim";
	}
}
