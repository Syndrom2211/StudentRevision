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
use Illuminate\Http\Request;
Route::get('/', 'HomeController@index')->name('home');

//=========Upload Proposal
Route::get('/upload_proposal', 'HomeController@upload_proposal')->name('upload_proposal');

Route::post('/upload_proposal_proses', 'HomeController@upload_proposal_proses')->name('upload_proposal_proses');
//=========Upload Proposal

//=== EDIT PROPOSAL
Route::get('/proposalku/edit/{id_proposal}', 'HomeController@edit_proposalku');
Route::post('/proposalku/proposalku_ubah_proses', 'HomeController@edit_proposalku_ubah');

//=== HAPUS PROPOSAL
Route::get('/proposalku/hapus/{id_proposal}','HomeController@hapus_proposalku');

//=== LIHAT KOMENTAR
Route::get('/proposalku/komentar/{id_proposal}', 'HomeController@lihat_komentar')->name('lihat_komentar');

// Route untuk user yang admin
Route::get('/proposalku/{id}', 'HomeController@proposalku')->name('proposalku');

Auth::routes();

Route::get('/pengaturan_mhs/{id}', 'HomeController@pengaturan_mhs')->name('pengaturan_mhs');

Route::get('/pengaturan_mhs_ubah/{id}', 'HomeController@pengaturan_mhs_ubah')->name('pengaturan_mhs_ubah');

Route::get('/data_mhs_bimbingan', 'HomeController@data_mhs_bimbingan')->name('data_mhs_bimbingan');

Route::get('/data_mhs_bimbingan/edit/{id_mhs_bimbingan}', 'HomeController@edit_data_mhs_bimbingan')->name('edit_data_mhs_bimbingan');
Route::post('/data_mhs_bimbingan/edit_data_mhs_bimbingan_proses', 'HomeController@edit_data_mhs_bimbingan_proses');

Route::get('/tambah_data_mhs_bimbingan', 'HomeController@tambah_data_mhs_bimbingan')->name('tambah_data_mhs_bimbingan');

Route::post('/proses_tambah_data_mhs_bimbingan', 'HomeController@proses_tambah_data_mhs_bimbingan')->name('proses_tambah_data_mhs_bimbingan');

Route::post('/proses_notifikasi_revisi', 'HomeController@proses_notifikasi_revisi');

Route::get('/proposalku/komentar/petunjuk_revisi/{id_komentar}', 'HomeController@petunjuk_revisi')->name('petunjuk_revisi');