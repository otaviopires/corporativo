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
    Route::get('/home', 'PortalController@index')->name('home');
    Route::resource('/faq', 'FaqController')->except(['show','edit','update']);
	Route::resource('/tel', 'TelController');
	Route::resource('/forum', 'ForumController')->except(['show','edit','update']);
	Route::get('events', 'EventController@index')->name('events.index');
	Route::post('events', 'EventController@addEvent')->name('events.add');


});

Route::resources([
	'pfs' => 'Portal\PfsController'
]);


Route::resources([
	'ogs' => 'Portal\OgsController'
]);



