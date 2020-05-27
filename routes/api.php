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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
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
Route::get('/propinsi', 'funcController@propinsi');
Route::get('/kabupaten/{id}', 'funcController@kabupaten');
Route::get('/kecamatan/{id}', 'funcController@kecamatan');
Route::get('/kelurahan/{id}', 'funcController@kelurahan');
Route::get('/transportasi', 'funcController@transportasi');
Route::get('/jarak', 'funcController@jarak');
Route::get('/pekerjaan', 'funcController@pekerjaan');
Route::get('/pendidikan', 'funcController@pendidikan');
Route::get('/penghasilan', 'funcController@penghasilan');
Route::get('/jumlah_pendaftar', 'funcController@jumlah_pendaftar');
Route::post('/informasi', 'funcController@set_informasi');
Route::post('/informasi', 'funcController@edit_informasi');
Route::post('/informasi', 'funcController@delete_informasi');
Route::post('/registrasi', 'RegistrationController@submitRegistration');