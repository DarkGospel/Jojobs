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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/configuracion/{id}','UserController@config')->name('config');
Route::get('/eliminar/{id}','UserController@eliminar')->name('eliminar');
Route::get('/activar/{id}','UserController@activar')->name('activar');
Route::get('/desactivar/{id}','UserController@desactivar')->name('desactivar');
Route::get('/listar','UserController@listar')->name('listar');
Route::get('/solicitudes','UserController@solicitudes')->name('solicitudes');
Route::post('/user/update','UserController@update')->name('user.update');
Route::get('/user/avatar/{filename}','UserController@getImage')->name('user.avatar');
Route::get('/logs','LogsController@Index')->name('logs');
Route::get('pdflogs', 'LogsController@pdf')->name('logspdf');
Route::get('pdf', 'UserController@pdf')->name('pdf');
Route::get('/cv', 'UserController@cv')->name('cv');
Route::get('/perfil/{id}', 'UserController@perfil')->name('perfil');
Route::post('/enviar','MessageController@enviar')->name('enviar');
Route::get('/mensajes', 'MessageController@listar')->name('listarmensajes');
Route::get('/nuevomensaje', 'UserController@nuevo')->name('mensaje');