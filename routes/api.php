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
Route::post('/bersihkanData', 'funcController@bersihkanData'); //bersihkan semua data pendaftar
Route::post('/images', 'funcController@uploadImage'); //upload foto di info
Route::post('/uploadLampiran', 'funcController@uploadLampiran'); //upload lampiran atau foto
Route::post('/uploadFoto', 'funcController@uploadFoto'); //upload foto
Route::post('/hapusfile', 'funcController@hapusFile'); //hapus dokumen
Route::post('/updateLampiranUser', 'funcController@updateLampiranUser'); //update lampiran db user
Route::post('/hapusLampiranUser', 'funcController@hapusLampiranUser'); //hapus lampiran db user
Route::post('/cekpin', 'funcController@cekPin'); // cek pin untuk print
Route::get('/agama', 'funcController@agama');
Route::get('/hobi', 'funcController@hobi'); // get hobi
Route::delete('/hobi/{id}', 'funcController@hapusHobi'); // hapus hobi
Route::post('/hobi', 'funcController@simpanHobi'); // simpan hobi
Route::get('/cita_cita', 'funcController@cita_cita'); // get cita-cita
Route::delete('/cita_cita/{id}', 'funcController@hapusCita'); // hapus cita-cita
Route::post('/cita_cita', 'funcController@simpanCita'); // simpan cita-cita
Route::get('/jenis_tinggal', 'funcController@jenis_tinggal');
Route::get('/mapel', 'funcController@mapel'); // get mapel
Route::delete('/mapel/{id}', 'funcController@hapusMapel'); // hapus mapel
Route::post('/mapel', 'funcController@simpanMapel'); // simpan mapel
Route::get('/peminatan', 'funcController@peminatan'); // get peminatan
Route::delete('/peminatan/{id}', 'funcController@hapusPeminatan'); // hapus peminatan
Route::post('/peminatan', 'funcController@simpanPeminatan'); // simpan peminatan
Route::get('/hubungan', 'funcController@hubungan');
Route::get('/kelas', 'funcController@kelas'); //get kelas
Route::delete('/kelas/{id}', 'funcController@hapusKelas'); // hapus kelas
Route::post('/kelas', 'funcController@simpanKelas'); // simpan kelas
Route::get('/tahun_ajaran', 'funcController@TahunAjaran'); //get tahun_ajaran
Route::delete('/tahun_ajaran/{id}', 'funcController@hapusTahunAjaran'); // hapus tahun_ajaran
Route::post('/tahun_ajaran', 'funcController@simpanTahunAjaran'); // simpan tahun_ajaran
Route::post('/profil', 'funcController@simpanProfil'); // simpan profil
Route::post('/kelasPendaftar', 'funcController@setKelasPendaftar');
Route::post('/deletekelasPendaftar', 'funcController@deleteKelasPendaftar');
Route::post('/cekKelasPendaftar', 'funcController@cekKelasPendaftar');
Route::post('/ispinvalid', 'funcController@isPinValid'); //cek pin
Route::get('/propinsi', 'funcController@propinsi');
Route::get('/kabupaten/{id}', 'funcController@kabupaten');
Route::get('/kecamatan/{id}', 'funcController@kecamatan');
Route::get('/kelurahan/{id}', 'funcController@kelurahan');
Route::get('/transportasi', 'funcController@transportasi'); // get transportasi
Route::delete('/transportasi/{id}', 'funcController@hapusTansportasi'); // hapus transportasi
Route::post('/transportasi', 'funcController@simpanTransportasi'); // simpan transportasi
Route::get('/jarak', 'funcController@jarak'); // get jarak
Route::delete('/jarak/{id}', 'funcController@hapusJarak'); // hapus jarak
Route::post('/jarak', 'funcController@simpanJarak'); // simpan jarak
Route::get('/jadwalppdb', 'funcController@jadwal_ppdb'); //jadwal ppdb
Route::get('/pekerjaan', 'funcController@pekerjaan'); // get pekerjaan
Route::delete('/pekerjaan/{id}', 'funcController@hapusPekerjaan'); // hapus pekerjaan
Route::post('/pekerjaan', 'funcController@simpanPekerjaan'); // simpan pekerjaan
Route::get('/pendidikan', 'funcController@pendidikan'); // get pendidikan
Route::delete('/pendidikan/{id}', 'funcController@hapuspendidikan'); // hapus pendidikan
Route::post('/pendidikan', 'funcController@simpanPendidikan'); // simpan pendidikan
Route::get('/penghasilan', 'funcController@penghasilan'); // get penghasilan
Route::delete('/penghasilan/{id}', 'funcController@hapusPenghasilan'); // hapus penghasilan
Route::post('/penghasilan', 'funcController@simpanPenghasilan'); // simpan penghasilan
Route::get('/setting', 'funcController@setting'); //get setting
Route::delete('/setting/{id}', 'funcController@hapusSetting'); // hapus setting
Route::post('/setting', 'funcController@simpanSetting'); // simpan setting
Route::get('/jumlah_pendaftar', 'funcController@jumlah_pendaftar');
Route::get('/jumlah_tervalidasi', 'funcController@jumlah_tervalidasi');
Route::get('/jumlah_lulus', 'funcController@jumlah_lulus');
Route::post('/informasi', 'funcController@edit_informasi');
Route::get('/informasi', 'funcController@info');
Route::post('/registrasi', 'RegistrationController@submitRegistration'); //registrasi
Route::get('/tesquery', 'RegistrationController@tesquery'); //tes query
Route::post('/cekpendaftar', 'RegistrationController@cekPendaftar'); // cek pendaftar dgn noreg
Route::post('/afterregistrationsuccesspdf', 'RegistrationController@afterRegistrationSuksesPdf'); //after sukses registration return pdf
Route::post('/afterregistrationsuccess', 'RegistrationController@afterRegistrationSukses'); //after sukses registration return data
Route::get('/karturegistrasi', 'RegistrationController@kartuRegistrasi');
Route::post('/login', 'Auth\LoginController@login'); //login
Route::post('/cekstatus', 'funcController@status'); //cek status
Route::post('/updatestatus', 'funcController@updatestatus'); //update status
Route::post('/kirimpesan', 'funcController@kirimpesan'); // kirim pesan dari kontak menu
Route::post('/setwaktu', 'funcController@setwaktu');
Route::get('/analytics-pv', 'funcController@getAnalytics');
Route::get('/analytics', 'funcController@analytic');
Route::get('/browser-ga', 'funcController@getBrowserAnalytics');
Route::get('/visitors', 'funcController@getVisitors');
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
Route::get('/barcode', function() {
	$generator = new Picqer\Barcode\BarcodeGeneratorHTML();
echo $generator->getBarcode('https://ppdb.man2bulukumba.sch.id/status/BKG45KKH52KJ', $generator::TYPE_CODE_128);
});