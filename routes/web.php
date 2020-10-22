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
//ブログ一覧表示
Route::get('/', 'App\Http\Controllers\BlogController@showList')->name('blogs');
//ブログ登録画面
Route::get('/create','App\Http\Controllers\BlogController@showCreate')->name('create');
//ブログ登録
Route::post('/store','App\Http\Controllers\BlogController@exeStore')->name('store');
//ブログ詳細表示
Route::get('/{id}', 'App\Http\Controllers\BlogController@showDetail')->name('detail');
//ブログ編集画面表示
Route::get('/edit/{id}','App\Http\Controllers\BlogController@showEdit')->name('edit');
//ブログ更新
Route::post('/update','App\Http\Controllers\BlogController@exeUpdate')->name('update');
//ブログ削除
Route::post('/delete/{id}','App\Http\Controllers\BlogController@exeDelete')->name('delete');
