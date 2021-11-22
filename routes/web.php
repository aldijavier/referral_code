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


Route::get('/login','AuthController@login')->name('login');
Route::post('/postlogin','AuthController@postlogin');
Route::get('/logout','AuthController@logout');

Route::get('/redirect-referral/{q}', 'AuthController@postlogin');

Route::group(['prefix' => 'api'], function () {
    Route::get('dashboard', 'Api\DashboardController@index');
    Route::get('members', 'Api\MembersController@index');
    Route::get('ref-promo', 'ApiController@GetAllReferralPromo');
    Route::get('ref-agent', 'ApiController@GetAllReferralAgent');
    Route::get('ref-agentext', 'ApiController@GetAllReferralAgentExt');
});


//Export
Route::get('/tickets/rfo/{id}', 'App\Http\Controllers\ExportController@rfo')->middleware(['checkRole:Super Admin,User,Customer Care,BOD']);
Route::get('/tickets/rfo_maintenance/{id}', 'App\Http\Controllers\ExportController@rfoMaintenance')->middleware(['checkRole:Super Admin,User,Customer Care,BOD']);
Route::post('/tickets/export', 'ExportController@export');
Route::post('/tickets/exportkeluar', 'ExportController@exportkeluar');
Route::post('/tickets/exportreturn', 'ExportController@exportreturn');
Route::post('/tickets/exportLogAssign', 'App\Http\Controllers\ExportController@exportLogAssign')->middleware(['checkRole:Super Admin,User,Customer Care,BOD']);
Route::post('/tickets_internal/exportLogAssign', 'App\Http\Controllers\ExportController@exportLogAssign')->middleware(['checkRole:Super Admin,User,Customer Care,BOD']);
Route::post('/tickets/export-bulk-Assign', 'App\Http\Controllers\ExportController@exportBulkAssign')->middleware(['checkRole:Super Admin,User,Customer Care,BOD']);
//End export

Route::post('searchreferral', 'ReferralController@searchDate')->name('report');
Route::post('searchreferralagent', 'ReferralAgentController@searchDate')->name('reportagent');
Route::post('searchreferralext', 'ReferralExtController@searchDate')->name('reportext');
Route::get('/promocodeapi', 'ChartController@chart')->name('promocodeapi');
Route::group(['middleware' => ['auth','checkRole:admin,petugas']], function () {

    Route::get('/', function () {
        return view('/dashboard');
    });

    Route::get('/dashboard','DashboardController@index')->name('dashboard');

    Route::get('/suratmasuk','SuratMasukController@index');
    Route::get('/suratmasuk/index','SuratMasukController@index');
    Route::get('/suratmasuk/create','SuratMasukController@create');
    Route::post('/suratmasuk/tambah','SuratMasukController@tambah');
    Route::get('/suratmasuk/{id}/tampil','SuratMasukController@tampil');
    Route::get('viewAlldownloadfile','SuratMasukController@downfunc');
    Route::get('/suratmasuk/{id}/edit','SuratMasukController@edit');
    Route::post('/suratmasuk/{id}/update','SuratMasukController@update');
    Route::get('/suratmasuk/{id}/delete','SuratMasukController@delete');
    Route::get('/suratmasuk/agenda','SuratMasukController@agenda');
    Route::get('/suratmasuk/agendamasukcetak_pdf', 'SuratMasukController@agendamasukcetak_pdf');
    Route::get('/suratmasuk.agendamasukdownload_excel', 'SuratMasukController@agendamasukdownload_excel')->name('suratmasuk.downloadexcel');
    Route::get('/suratmasuk/galeri','SuratMasukController@galeri');


    // referral 
    Route::get('/referral','ReferralController@index');
    Route::get('/referral/index','ReferralController@index')->name('ref_index');
    Route::get('/referral/create','ReferralController@create')->name('referral_create');
    Route::post('/referral/tambah','ReferralController@tambah');
    Route::get('/referral/{id}/edit','ReferralController@edit');
    Route::post('/referral/{id}/update','ReferralController@update');
    Route::get('/referral/{id}/delete','ReferralController@delete');
    Route::get('/json-lantai', 'ReferralController@lantai')->name('jsonLantai');
    Route::get('/suratmasuk/{id}/tampil','SuratMasukController@tampil');
    Route::get('viewAlldownloadfile','SuratMasukController@downfunc');
    Route::get('/suratmasuk/{id}/edit','SuratMasukController@edit');
    Route::post('/suratmasuk/{id}/update','SuratMasukController@update');
    Route::get('/suratmasuk/{id}/delete','SuratMasukController@delete');
    Route::get('/suratmasuk/agenda','SuratMasukController@agenda');
    Route::get('/suratmasuk/agendamasukcetak_pdf', 'SuratMasukController@agendamasukcetak_pdf');
    Route::get('/suratmasuk.agendamasukdownload_excel', 'SuratMasukController@agendamasukdownload_excel')->name('suratmasuk.downloadexcel');
    Route::get('/suratmasuk/galeri','SuratMasukController@galeri');

    // referral agent
    Route::get('/referralagent','ReferralAgentController@index');
    Route::get('/referralagent/index','ReferralAgentController@index')->name('refagent_index');
    Route::get('/referralagent/create','ReferralAgentController@create');
    Route::post('/referralagent/tambah','ReferralAgentController@tambah');
    Route::get('/referralagent/{id}/edit','ReferralAgentController@edit');
    Route::post('/referralagent/{id}/update','ReferralAgentController@update');
    Route::get('/referralagent/{id}/delete','ReferralAgentController@delete');
    Route::get('/suratmasuk/{id}/tampil','SuratMasukController@tampil');
    Route::get('viewAlldownloadfile','SuratMasukController@downfunc');
    Route::get('/suratmasuk/{id}/edit','SuratMasukController@edit');
    Route::post('/suratmasuk/{id}/update','SuratMasukController@update');
    Route::get('/suratmasuk/{id}/delete','SuratMasukController@delete');
    Route::get('/suratmasuk/agenda','SuratMasukController@agenda');
    Route::get('/suratmasuk/agendamasukcetak_pdf', 'SuratMasukController@agendamasukcetak_pdf');
    Route::get('/suratmasuk.agendamasukdownload_excel', 'SuratMasukController@agendamasukdownload_excel')->name('suratmasuk.downloadexcel');
    Route::get('/suratmasuk/galeri','SuratMasukController@galeri');

    // referral ext
    Route::get('/referralext','ReferralExtController@index');
    Route::get('/referralext/index','ReferralExtController@index')->name('refext_index');
    Route::get('/referralext/create','ReferralExtController@create');
    Route::post('/referralext/tambah','ReferralExtController@tambah');
    Route::get('/referralext/{id}/edit','ReferralExtController@edit');
    Route::post('/referralext/{id}/update','ReferralExtController@update');
    Route::get('/referralext/{id}/delete','ReferralExtController@delete');
    Route::get('/suratmasuk/{id}/tampil','SuratMasukController@tampil');
    Route::get('viewAlldownloadfile','SuratMasukController@downfunc');
    Route::get('/suratmasuk/agenda','SuratMasukController@agenda');
    Route::get('/suratmasuk/agendamasukcetak_pdf', 'SuratMasukController@agendamasukcetak_pdf');
    Route::get('/suratmasuk.agendamasukdownload_excel', 'SuratMasukController@agendamasukdownload_excel')->name('suratmasuk.downloadexcel');
    Route::get('/suratmasuk/galeri','SuratMasukController@galeri');

    Route::get('/suratkeluar', 'SuratKeluarController@index');
    Route::get('/suratkeluar/index','SuratKeluarController@index');
    Route::get('/suratkeluar/create','SuratKeluarController@create');
    Route::post('/suratkeluar/tambah','SuratKeluarController@tambah');
    Route::get('/suratkeluar/{id}/tampil','SuratKeluarController@tampil');
    Route::get('viewAlldownloadfile','SuratKeluarController@downfunc');
    Route::get('/suratkeluar/{id}/edit','SuratKeluarController@edit');
    Route::post('/suratkeluar/{id}/update','SuratKeluarController@update');
    Route::get('/suratkeluar/{id}/delete','SuratKeluarController@delete');
    Route::get('/suratkeluar/agenda','SuratKeluarController@agenda');
    Route::get('/suratkeluar/agendakeluarcetak_pdf','SuratKeluarController@agendakeluarcetak_pdf');
    Route::get('/suratkeluar.agendakeluardownload_excel','SuratKeluarController@agendakeluardownload_excel')->name('suratkeluar.downloadexcel');
    Route::get('/suratkeluar/galeri','SuratKeluarController@galeri');


    Route::get('/klasifikasi', 'KlasifikasiController@index');
    Route::get('/klasifikasi/index','KlasifikasiController@index');
    Route::get('/klasifikasi/create','KlasifikasiController@create');
    Route::post('/klasifikasi/tambah','KlasifikasiController@tambah');
    Route::get('/klasifikasi/{id}/edit','KlasifikasiController@edit');
    Route::post('/klasifikasi/{id}/update','KlasifikasiController@update');
    Route::get('/klasifikasi/{id}/delete','KlasifikasiController@delete');

    //Route untuk Modal Import Data
    // Route::post('/klasifikasi/import','KlasifikasiController@importexcel')->name('klasifikasi.import');
    Route::post('/klasifikasi.import', 'KlasifikasiController@import');

    Route::get('disposisi/{suratmasuk}', 'DisposisiController@index')->name('disposisi.index');
    Route::post('disposisi/{suratmasuk}', 'DisposisiController@store')->name('disposisi.store');
    Route::get('disposisi/{suratmasuk}/create', 'DisposisiController@create')->name('disposisi.create');
    Route::get('disposisi/{suratmasuk}/{id}/edit', 'DisposisiController@edit')->name('disposisi.edit');
    Route::get('disposisi/{suratmasuk}/{id}', 'DisposisiController@update')->name('disposisi.update');
    Route::delete('disposisi/{suratmasuk}/{id}', 'DisposisiController@destroy')->name('disposisi.destroy');
    Route::get('/disposisi/{suratmasuk}/{id}/download', 'DisposisiController@download')->name('disposisi.download');
});

Route::group(['middleware' => ['auth','checkRole:admin']], function () {
    Route::resource('/instansi','InstansiController');
    Route::resource('/pengguna','PenggunaController');
    Route::resource('/audit','AuditLogController');
});
