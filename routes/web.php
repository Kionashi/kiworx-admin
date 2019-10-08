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
//Companies
Route::get('/companies', 'CompaniesController@index')->name('companies');

//Admin Users
Route::get('/admin/users', 'AdminUsersController@index')->name('admin/users');
Route::get('/admin/users/create', 'AdminUsersController@create')->name('admin/users/create');
Route::post('/admin/users/store', 'AdminUsersController@store')->name('admin/users/store');
Route::get('/admin/users/edit/{id}', 'AdminUsersController@edit')->name('admin/users/edit');
Route::post('/admin/users/update', 'AdminUsersController@update')->name('admin/users/update');
Route::get('/admin/users/details/{id}', 'AdminUsersController@details')->name('admin/users/details');
Route::get('/admin/users/delete/{id}', 'AdminUsersController@destroy')->name('admin/users/delete');

Route::group(['middleware' => ['auth']], function () {
    //Users
    Route::get('/users', 'UsersController@index')->name('users');
    Route::get('/users/create', 'UsersController@create')->name('users/create');
    Route::post('/users/store', 'UsersController@store')->name('users/store');
    Route::get('/users/edit/{id}', 'UsersController@edit')->name('users/edit');
    Route::post('/users/update', 'UsersController@update')->name('users/update');
    Route::get('/users/details/{id}', 'UsersController@details')->name('users/details');
    Route::get('/users/delete/{id}', 'UsersController@destroy')->name('users/delete');
    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout-get');
    
    //Events
    Route::get('/events', 'EventsController@index')->name('events');
    Route::get('/events/create', 'EventsController@create')->name('events/create');
    Route::post('/events/store', 'EventsController@store')->name('events/store');
    Route::get('/events/edit/{id}', 'EventsController@edit')->name('events/edit');
    Route::post('/events/update', 'EventsController@update')->name('events/update');
    Route::get('/events/details/{id}', 'EventsController@details')->name('events/details');
    Route::get('/events/delete/{id}', 'EventsController@delete')->name('events/delete');
    
    //Campaings
    Route::get('/campaings', 'CampaingsController@index')->name('campaings');
    Route::get('/campaings/create', 'CampaingsController@create')->name('campaings/create');
    Route::post('/campaings/store', 'CampaingsController@store')->name('campaings/store');
    Route::get('/campaings/edit/{id}', 'CampaingsController@edit')->name('campaings/edit');
    Route::post('/campaings/update', 'CampaingsController@update')->name('campaings/update');
    Route::get('/campaings/details/{id}', 'CampaingsController@details')->name('campaings/details');
    Route::get('/campaings/delete/{id}', 'CampaingsController@delete')->name('campaings/delete');
    Route::post('/campaings/vehicles/import', 'CampaingsController@importExcel')->name('/campaings/vehicles/import');
    
    //Vehicles
    Route::get('/vehicles', 'VehiclesController@index')->name('vehicles');
    Route::get('/vehicles/create', 'VehiclesController@create')->name('vehicles/create');
    Route::post('/vehicles/store', 'VehiclesController@store')->name('vehicles/store');
    Route::get('/vehicles/edit/{id}', 'VehiclesController@edit')->name('vehicles/edit');
    Route::post('/vehicles/update', 'VehiclesController@update')->name('vehicles/update');
    Route::get('/vehicles/details/{id}', 'VehiclesController@details')->name('vehicles/details');
    Route::get('/vehicles/delete/{id}', 'VehiclesController@delete')->name('vehicles/delete');
    
    //Workshops
    Route::get('/workshops', 'WorkshopsController@index')->name('workshops');
    Route::get('/workshops/create', 'WorkshopsController@create')->name('workshops/create');
    Route::post('/workshops/store', 'WorkshopsController@store')->name('workshops/store');
    Route::get('/workshops/edit/{id}', 'WorkshopsController@edit')->name('workshops/edit');
    Route::post('/workshops/update', 'WorkshopsController@update')->name('workshops/update');
    Route::get('/workshops/details/{id}', 'WorkshopsController@details')->name('workshops/details');
    Route::get('/workshops/delete/{id}', 'WorkshopsController@delete')->name('workshops/delete');
});


//Test
Route::get('/test', 'TestsController@test')->name('test');
Route::post('/test-post', 'TestsController@testPost')->name('test-post');
