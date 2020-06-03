<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
    // return $request->user();
// });
Route::post('/images', 'funcController@uploadImage');
Route::post('/uploadImageRegistration', 'funcController@uploadImageRegistration');
Route::post('/uploadLampiran', 'funcController@uploadLampiran');
Route::post('/hapusFileDokumen', 'funcController@hapusFileDokumen');
Route::get('/agama', 'funcController@agama');
Route::get('/hobi', 'funcController@hobi');
Route::get('/cita_cita', 'funcController@cita_cita');
Route::get('/jenis_tinggal', 'funcController@jenis_tinggal');
Route::get('/mapel', 'funcController@mapel');
Route::get('/hubungan', 'funcController@hubungan');
Route::get('/kelas', 'funcController@kelas');
Route::post('/kelasPendaftar', 'funcController@setKelasPendaftar');
Route::post('/deletekelasPendaftar', 'funcController@deleteKelasPendaftar');
Route::post('/cekKelasPendaftar', 'funcController@cekKelasPendaftar');
Route::post('/ispinvalid', 'funcController@isPinValid'); //cek pin
Route::get('/propinsi', 'funcController@propinsi');
Route::get('/kabupaten/{id}', 'funcController@kabupaten');
Route::get('/kecamatan/{id}', 'funcController@kecamatan');
Route::get('/kelurahan/{id}', 'funcController@kelurahan');
Route::get('/transportasi', 'funcController@transportasi');
Route::get('/jarak', 'funcController@jarak');
Route::get('/jadwalppdb', 'funcController@jadwal_ppdb');
Route::get('/pekerjaan', 'funcController@pekerjaan');
Route::get('/pendidikan', 'funcController@pendidikan');
Route::get('/penghasilan', 'funcController@penghasilan');
Route::get('/jumlah_pendaftar', 'funcController@jumlah_pendaftar');
Route::get('/jumlah_tervalidasi', 'funcController@jumlah_tervalidasi');
Route::get('/jumlah_lulus', 'funcController@jumlah_lulus');
Route::post('/informasi', 'funcController@edit_informasi');
Route::get('/informasi', 'funcController@info');
Route::post('/registrasi', 'RegistrationController@submitRegistration'); //registrasi
Route::post('/kirimAttachment', 'RegistrationController@kirimAttachment'); //kirim attachment
Route::post('/suratpernyataansiswapdf', 'RegistrationController@suratPernyataanSiswa');
Route::post('/suratpernyataanwalipdf', 'RegistrationController@suratPernyataanWali');
Route::post('/afterregistrationsuccess', 'RegistrationController@afterRegistrationSukses'); //after sukses registration
Route::post('/login', 'Auth\LoginController@login');
Route::post('/cekstatus', 'funcController@status');
Route::post('/updatestatus', 'funcController@updatestatus');
Route::post('/kirimpesan', 'funcController@kirimpesan'); // kirim pesan dari kontak menu
Route::post('/setwaktu', 'funcController@setwaktu');
Route::get('/analytics-pv', 'funcController@getAnalytics');
Route::get('/analytics', 'funcController@analytic');
Route::get('/browser-ga', 'funcController@getBrowserAnalytics');
Route::get('/visitors', 'funcController@getVisitors');
Route::get('/clearAttachment', 'funcController@clearAttachment');
Route::get('/suratpernyataansiswa', 'suratPernyataanController@suratPernyataanSiswa'); //testing
Route::get('/suratpernyataanwali', 'suratPernyataanController@suratPernyataanWali'); //testing
Route::get('/teskelas', 'TestController@pendaftar'); //testing
Route::get('/teskirimpesan', function(){
	$data = [
		'nama' => 'Rahmat Sani',
		'subjek' => '[PENTING] Kartu Registrasi PPDB MAN 2 Bulukumba',
		'no_registrasi' => 'BKG45KKH52KJ',
		'pin' => '26113'
	];
	return (new App\Mail\registrasiEmail($data))->render();
});
Route::get('/teskartu', 'TestController@teskartu');
Route::get('/bcrypt123', function(){
	return bcrypt('123456');
});