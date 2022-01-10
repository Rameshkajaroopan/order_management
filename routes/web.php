<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Carbon;


Route::get('/test' , function(){
return view('test');
});
// Route::get('/mobileLogin',  'App\Http\Controllers\mobile\loginController@index');

// login for web
Route::get('/',  'App\Http\Controllers\AdminloginController@index');
Route::post('/adminlogin',  'App\Http\Controllers\AdminloginController@login');
Route::get('/adminlogout',  'App\Http\Controllers\AdminloginController@logout')->name('logout');

Route::group(['middleware' => ['is_admin']], function () {

// dasboard
Route::get('/dashboard',  'App\Http\Controllers\AdminloginController@dashboard')->name('dashboard');

// user crud function
Route::get('/user',  'App\Http\Controllers\UserController@index')->name('user.index');
Route::get('/user/add',  'App\Http\Controllers\UserController@create')->name('user.create');
Route::post('/user',  'App\Http\Controllers\UserController@store')->name('user.store');
Route::get('/user/{id}/edit',  'App\Http\Controllers\UserController@edit')->name('user.edit');
Route::post('/user/{id}/update',  'App\Http\Controllers\UserController@update')->name('user.update');
Route::get('/user/{id}/delete',  'App\Http\Controllers\UserController@destroy')->name('user.destroy');

// branch crud function
Route::get('/branch',  'App\Http\Controllers\BranchController@index')->name('branch.index');
Route::get('/branch/add',  'App\Http\Controllers\BranchController@create')->name('branch.create');
Route::post('/branch',  'App\Http\Controllers\BranchController@store')->name('branch.store');
Route::get('/branch/{id}/edit',  'App\Http\Controllers\BranchController@edit')->name('branch.edit');
Route::post('/branch/{id}/update',  'App\Http\Controllers\BranchController@update')->name('branch.update');
Route::get('/branch/{id}/delete',  'App\Http\Controllers\BranchController@destroy')->name('branch.destroy');

// location crud function
Route::get('/location',  'App\Http\Controllers\LocationController@index')->name('location.index');
Route::get('/location/add',  'App\Http\Controllers\LocationController@create')->name('location.create');
Route::post('/location',  'App\Http\Controllers\LocationController@store')->name('location.store');
Route::get('/location/{id}/edit',  'App\Http\Controllers\LocationController@edit')->name('location.edit');
Route::post('/location/{id}/update',  'App\Http\Controllers\LocationController@update')->name('location.update');
Route::get('/location/{id}/delete',  'App\Http\Controllers\LocationController@destroy')->name('location.destroy');
// get completed orders
Route::get('/completedOrder',  'App\Http\Controllers\OrderController@completedOrder')->name('order.completedOrder');
// get pending orders
Route::get('/pendingOrder',  'App\Http\Controllers\OrderController@pendingOrder')->name('order.pendingOrder');
Route::get('/viewOrder',  'App\Http\Controllers\OrderController@viewOrder')->name('order.viewOrder');
Route::get('/changeWorking',  'App\Http\Controllers\OrderController@changeWorking')->name('order.changeWorking');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});





