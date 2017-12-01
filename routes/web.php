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
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('clinica', 'ClinicasController');
Route::resource('usuario', 'UsuarioController');
Route::get('/listarClinicas', 'UsuarioController@listarClinicas');
Route::get('/listarClinicas', 'HomeController@listarClinicas');
Route::get('/busca', 'SearchController@busca');
Route::get('/search', 'ClinicasController@find');
Route::post('/mapa', 'ClinicasController@mapa');
Route::get('/', function () {
    return view('search');
});
Route::get('/base', function () {
    return view('base');
});

Route::get('/chat', 'ChatController@index')->name('chat');
Route::get('/chat/messages', 'ChatMessageController@index');
Route::post('/chat/messages', 'ChatMessageController@store');


Route::get('/', function () {
    return view('welcome');
});



Route::resource('usuarios', 'UsuarioController');
//Route::resource('fornecedores', 'FornecedorController')->middleware('auth');
Route::resource('fornecedores', 'FornecedorController');
Route::get('/listarFornecedores', 'FornecedorController@listarFornecedores');

//Route::resource('produtos', 'ProdutoController')->middleware('auth');
Route::resource('produtos', 'ProdutoController');
Route::get('/listarProdutos', 'ProdutoController@listarProdutos');
Route::get('/total'. 'ProdutoController@total');
