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
Route::get('/login', 'AuthController@login')->name('login');
Route::post('/login', 'AuthController@storeSession')->name('login');
Route::get('/password-recovery', 'AuthController@passwordRecovery')->name('password-recovery');
Route::post('/password-recovery', 'AuthController@passwordEmail')->name('password-recovery');

Route::group(['middleware' => ['admin.auth','admin.notifications']], function () {
    
    // Home
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/help', 'HelpController@index')->name('help');
    Route::post('/help', 'HelpController@store')->name('help');
    
    Route::post('/search-home', 'HomeController@getHomeData')->name('search-home');
    
    Route::get('/logout', 'AuthController@logout')->name('logout');
    
    // Admin Users
    Route::get('/profile', 'AdminUsersController@profile')->name('profile');
    Route::get('/change-password', 'AdminUsersController@changePassword')->name('change-password');
    Route::post('/change-password', 'AdminUsersController@updatePassword')->name('change-password');
    Route::get('/admin-users', 'AdminUsersController@index')->name('admin-users');
    Route::get('/admin-users/create', 'AdminUsersController@create')->name('admin-users/create');
    Route::post('/admin-users/store', 'AdminUsersController@store')->name('admin-users/store');
    Route::get('/admin-users/edit/{id}', 'AdminUsersController@edit')->name('admin-users/edit');
    Route::post('/admin-users/update', 'AdminUsersController@update')->name('admin-users/update');
    Route::get('/admin-users/details/{id}', 'AdminUsersController@details')->name('admin-users/details');
    Route::get('/admin-users/delete/{id}', 'AdminUsersController@destroy')->name('admin-users/delete');
    
    // Users
    Route::get('/users', 'UsersController@index')->name('users');
    Route::get('/users/create', 'UsersController@create')->name('users/create');
    Route::post('/users/store', 'UsersController@store')->name('users/store');
    Route::get('/users/edit/{id}', 'UsersController@edit')->name('users/edit');
    Route::post('/users/update', 'UsersController@update')->name('users/update');
    Route::get('/users/details/{id}', 'UsersController@details')->name('users/details');
    Route::get('/users/delete/{id}', 'UsersController@destroy')->name('users/delete');
    Route::get('/candidates', 'UsersController@candidatesDatabase')->name('candidates');
    Route::get('/applicants/details/{id}', 'ApplicantsController@details')->name('applicants/details');
    
    // Companies
    Route::get('/companies', 'CompaniesController@index')->name('companies');
    Route::get('/companies/create', 'CompaniesController@create')->name('companies/create');
    Route::post('/companies/store', 'CompaniesController@store')->name('companies/store');
    Route::get('/companies/edit/{id}', 'CompaniesController@edit')->name('companies/edit');
    Route::post('/companies/update', 'CompaniesController@update')->name('companies/update');
    Route::get('/companies/details/{id}', 'CompaniesController@details')->name('companies/details');
    Route::get('/companies/delete/{id}', 'CompaniesController@destroy')->name('companies/delete');
    
    // Offers
    Route::get('/offers', 'OffersController@index')->name('offers');
    Route::get('/offers/create', 'OffersController@create')->name('offers/create');
    Route::post('/offers/store', 'OffersController@store')->name('offers/store');
    Route::get('/offers/edit/{id}', 'OffersController@edit')->name('offers/edit');
    Route::post('/offers/update', 'OffersController@update')->name('offers/update');
    Route::get('/offers/details/{id}/{phase}', 'OffersController@details')->name('offers/details');
    Route::get('/offers/delete/{id}', 'OffersController@destroy')->name('offers/delete');
    Route::post('/offers/promote', 'OffersController@promote')->name('offers/promote');
    Route::post('/offers/reject', 'OffersController@reject')->name('offers/reject');
    
    // Comments
    Route::post('/comments/store', 'CommentsController@store')->name('comments/store');
    
    // Notifications
    Route::get('/notifications', 'NotificationsController@index')->name('notifications');
    Route::get('/notifications/{id}', 'NotificationsController@details')->name('notifications/details');
    Route::get('/notifications/delete/{id}', 'NotificationsController@delete')->name('notifications/delete');
    Route::get('/notifications/deactivate/{id}', 'NotificationsController@deactivate')->name('notifications/deactivate');
    
});

// Job board
Route::get('/{company}/jobs', 'OffersController@publicList')->name('offer/public-list');
Route::get('/{company}/jobs/{code}', 'OffersController@publicDetail')->name('offer/public');
Route::post('/{company}/jobs/{code}', 'OffersController@storeApplyment')->name('offer/apply');

//Test
Route::get('/test', 'TestsController@index')->name('test');
Route::post('/test-post', 'TestsController@testPost')->name('test-post');

