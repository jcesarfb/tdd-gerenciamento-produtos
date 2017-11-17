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

Route::get('/usuarios', 'UsuarioController@index');
Route::post('/usuarios', 'UsuarioController@store');
Route::delete('/usuarios', 'UsuarioController@destroy');
Route::put('/usuarios/{id}', 'UsuarioController@update');

Route::get('/fornecedores', 'FornecedorController@index');
Route::post('/fornecedores', 'FornecedorController@store');
Route::delete('/fornecedores', 'FornecedorController@destroy');
Route::put('/fornecedores/{id}', 'FornecedorController@update');

Route::get('/produtos', 'ProdutoController@index');
Route::post('/produtos', 'ProdutoController@store');
Route::delete('/produtos', 'ProdutoController@destroy');
Route::put('/produtos/{id}', 'ProdutoController@update');