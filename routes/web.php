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
Route::get('/', ['as' => 'results', 'uses' => 'ResultsController@index']);
Route::get('/results', ['as' => 'results', 'uses' => 'ResultsController@index']);
Route::get('/results/{id}', ['as' => 'results-elections', 'uses' => 'ResultsController@showElection']);
Route::get('/results/elections/{id}', ['as' => 'results-municipality', 'uses' => 'ResultsController@showMunicipality']);

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
    Route::put('/polling-stations/{id}/add-user', 'PollingStationController@addUser')->name('polling-stations.add-user');
    Route::resource('/electionTypes', 'ElectionTypeController');
    Route::resource('/electoral-lists', 'ElectoralListController');
});

Route::get('/home', 'HomeController@index')->name('home');