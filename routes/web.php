<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/kirimemail','TestController@kirim_email');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/vuetest', 'VuetestController@index');
Route::get('/{any}', 'VueController@index')->where('any', '.*'); // ini diaktifkan
//Route::get('/', function(){ return 'PPDB MAN 2 BULUKUMBA'; });
// Route::post('/images', 'funcController@uploadImage');
//Route::get('/apps/{vue_capture?}', function () {
//    return view('index');
//   })->where('vue_capture', '[\/\w\.-]*');
// Route::prefix('apps')->group(function () {
    // Route::get('/{any}', 'VueController@index')->where('any', '.*');
// });