<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//Route::get('login','LoginController@authenticate');
Route::post('login','Auth\LoginController@authenticate');
Route::get('logout','Auth\LoginController@logout');


//////////GIANGVIEN/////


Route::get('loginGV','Auth\LoginControllerGV@showLoginGV')->name('loginGV');
Route::post('loginGV','Auth\LoginControllerGV@authenticateGV');

Route::get('logoutGV','Auth\LoginControllerGV@logout')->name('logoutGV');
Route::post('logoutGV','Auth\LoginControllerGV@logout');


Route::get('giangvien','GiangvienController@showQuanlySV'); //// index of GV


Route::get('giangvien/raKHLV','GiangvienController@showRaKHLV')->name('raKHLV');
Route::post('giangvien/raKHLV','GiangvienController@themKeHoach');

Route::get('giangvien/raDetai','GiangvienController@showRadetai')->name('raDetai');
Route::post('giangvien/raDetai','GiangvienController@radetai');

Route::get('dkdetai','SinhvienController@showDkdetai')->name('dkdetai'); // show trang dk
Route::get('dkdetai/{madetai}','SinhvienController@dangkydetai')->name('dkdetailv'); //khi bam vao nut dk

Route::get('quanlySV','GiangvienController@showQuanlySV')->name('quanlySV');

Route::get('duyetsv/{masv}','GiangvienController@duyetsv')->name('duyetsv');
Route::get('tuchoi_sv/{masv}','GiangvienController@tuchoi_sv')->name('tuchoi_sv');
Route::get('duyetsv_dexuat/{masv}/{madt}','GiangvienController@duyetsv_dexuat')->name('duyetsv_dexuat');
Route::get('tuchoi_sv_dexuat/{masv}/{madt}','GiangvienController@tuchoi_sv_dexuat')->name('tuchoi_sv_dexuat');


Route::get('dexuat','SinhvienController@showDexuat')->name('dexuat')->middleware('auth');
Route::post('dexuat','SinhvienController@dexuat');

Route::get('file','SinhvienController@showUploadForm')->name('file');
Route::post('file','SinhvienController@doUpload');

Route::get('chamdiem','GiangvienController@showChamdiem')->name('chamdiem');
Route::post('chamdiem','GiangvienController@chamdiem'); //khi bam vao nut Cham Diem

Route::get('test','TestController@showtest')->name('test');

Route::get('xemdiem','SinhvienController@showXemdiem')->name('xemdiem');

Route::get('giangvien/printPreview','GiangvienController@showprintPreview')->name('printPreview');


Route::get('search/{noidungsearch}','SinhvienController@search')->name('search');

Route::get('ds_detai','GiangvienController@show_dsdetai')->name('ds_detai');
