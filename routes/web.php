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

Route::get('/verify',['middleware' => 'securityAuth', function() {
    //
}]);

Route::get('/home', 'HomeController@index')->name('home');



Route::group(['middleware' => 'web'], function() {

   Route::resource('/uploads', 'UploadController')->middleware('auth');

});