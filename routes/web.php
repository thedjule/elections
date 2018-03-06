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

Route::group(['prefix' => '/manage', 'middleware' => 'role:superadministrator|administrator|user'], function () {
    Route::get('/', ['as' => 'manage', 'uses' => 'ManageController@index']);
    Route::get('/dashboard', ['as' => 'manage.dashboard', 'uses' => 'ManageController@dashboard']);
    Route::resource('/users', 'UserController');
    Route::resource('/roles', 'RoleController', ['except' => 'destroy']);
    Route::resource('/permissions', 'PermissionController', ['except' => 'destroy']);
    Route::resource('/default-municipalities', 'DefaultMunicipalityController');
    Route::resource('/default-polling-stations', 'DefaultPollingStationController');
    Route::resource('/elections', 'ElectionController');
    Route::resource('/municipalities', 'MunicipalityController');
    Route::resource('/polling-stations', 'PollingStationController');
    Route::resource('/electionTypes', 'ElectionTypeController');
    Route::resource('/electoral-lists', 'ElectoralListController');
});
Route::get('/home', 'HomeController@index')->name('home');