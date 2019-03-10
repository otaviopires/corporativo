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

Route::group(['namespace' => 'Admin', 'middleware' => 'can:adm'], function () {
    Route::resource('/usuarios', 'UsersController')->except(['create','show']);
    Route::resource('/roles', 'RolesController')->except(['create','show']);
});


Route::group(['namespace' => 'Portal',  'middleware' => 'auth'], function () {
	
	//PORTAL
	Route::redirect('/', '/home', 301);
	Route::get('/home', 'OgsController@retunDataToHomeChart')->name('home');
	

	//OGS
	Route::get('ogs/closed', 'OgsController@showClosedOgs');
	
	//PFS
	Route::get('pfs/list', 'PfsController@showClosedPfs');
	

	//SEARCH
	Route::post('ogs/closed/find', 'SearchController@searchOg');
	Route::get('ogs/closed/find', 'SearchController@searchOg');
	Route::post('/pfs/list/find', 'SearchController@searchPf');
	Route::post('/links/find', 'SearchController@searchLink');
	
	
	
	//EVENTS
	Route::get('events', 'EventController@index')->name('events.index');
	Route::post('events', 'EventController@addEvent')->name('events.add');
	
	//FAC
	Route::resource('/faq', 'FaqController')->except(['show','edit','update']);
	
	//FORUM
	Route::resource('/forum', 'ForumController')->except(['show','edit','update']);
	

	//ROTAS COMPLETAS PARA OS CONTROLLERS
	Route::resources([
		'ogs' => 'OgsController',
		'pfs' => 'PfsController',
		'tel' => 'TelController',
		'links' => 'UsefulLinksController'
	]);


});






