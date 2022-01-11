<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/amdin', function () {
    return 'you are admin, so you can not login in this site';
})->name('admin');


Route::get('/login',  'App\Http\Controllers\mobile\LoginController@index')->name('apilogin');
Route::get('/createLogin',  'App\Http\Controllers\mobile\LoginController@createLogin');


Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/dashboard',  'App\Http\Controllers\mobile\DashboardController@dashboard');

    Route::get('/newOrder',  'App\Http\Controllers\mobile\OrderController@newOrder');
    Route::get('/sentApprovedOrder',  'App\Http\Controllers\mobile\OrderController@sentApprovedOrder');
    Route::get('/sentApprovedCompletedOrder',  'App\Http\Controllers\mobile\OrderController@sentApprovedCompletedOrder');
    Route::get('/sentNotApprovedOrder',  'App\Http\Controllers\mobile\OrderController@sentNotApprovedOrder');
    Route::get('/notificationOrder',  'App\Http\Controllers\mobile\OrderController@notificationOrder');
    Route::get('/receivedNotCompletedOrder',  'App\Http\Controllers\mobile\OrderController@receivedNotCompletedOrder');
    Route::get('/receivedCompletedOrder',  'App\Http\Controllers\mobile\OrderController@receivedCompletedOrder');
    Route::get('/stuckOrder',  'App\Http\Controllers\mobile\OrderController@stuckOrder');
    Route::post('/createdOrder',  'App\Http\Controllers\mobile\OrderController@createdOrder');

    Route::get('/singleOrder',  'App\Http\Controllers\mobile\SingleOrderController@singleOrder');

    Route::post('/sendRequest',  'App\Http\Controllers\mobile\ButtonClickController@sendRequest');
    Route::post('/deliverSameBranch',  'App\Http\Controllers\mobile\ButtonClickController@deliverSameBranch');
    Route::post('/approved',  'App\Http\Controllers\mobile\ButtonClickController@approved');
    Route::post('/changeLocation',  'App\Http\Controllers\mobile\ButtonClickController@changeLocation');
    Route::post('/stuckOrderRequest',  'App\Http\Controllers\mobile\ButtonClickController@stuckOrderRequest');
    Route::get('/orderSearch',  'App\Http\Controllers\mobile\ButtonClickController@orderSearch');

    Route::get('/logout',  'App\Http\Controllers\mobile\LoginController@logout');
});
