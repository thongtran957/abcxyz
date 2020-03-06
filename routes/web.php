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
    return view('public.index');
});

Auth::routes(['register' => false, 'reset' => false ]);

Route::get('/crawler-data', "TestController@index")->name('test');

Route::get('/gg-drive', "TestController@testGoogleDrive")->name('test');

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard');
});