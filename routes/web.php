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
    
	Route::redirect('/', '/home', 301);
	
	Route::get('events', 'EventController@index')->name('events.index');
    Route::get('/home', 'PortalController@index')->name('home');
	Route::get('ogs/closed', 'OgsController@showClosedOgs');
	
	Route::post('events', 'EventController@addEvent')->name('events.add');
	
	Route::resource('/faq', 'FaqController')->except(['show','edit','update']);
	Route::resource('/forum', 'ForumController')->except(['show','edit','update']);
	
	Route::resources([
		'ogs' => 'OgsController',
		'pfs' => 'PfsController',
		'tel' => 'TelController'
	]);

});






