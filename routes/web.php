<?php

use Illuminate\Support\Facades\Route;

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

Route::redirect('/', 'login');


//Auth::routes();

Auth::routes(['register' => false]);

Route::group(['middleware' => 'auth'], function () {
	Route::redirect('home', 'product');
	Route::resource('user', 'UserController');
	Route::resource('product', 'ProductController');	
	Route::resource('player', 'PlayerController');	
	Route::resource('post', 'PostController');	
	Route::get('add-post', 'PostController@addVIew')->name('post.add');	
	Route::get('winner', 'PlayerController@winner')->name('winner');	
	Route::get('winner-list', 'PlayerController@winnerList')->name('winner-list');

	Route::get('add-product', 'ProductController@addProduct')->name('add-product');
	Route::resource('sub-admin', 'SubAdminController')->middleware('permission');	
	Route::get('/change-password', 'UserController@changePassword')->name('change-password');
	Route::post('/change-password', 'UserController@updatePassword')->name('change-password');	
	Route::get('content', 'HomeController@contentView')->name('content')->middleware('permission');
	Route::get('add-admin','SubAdminController@AddSubAdmin' )->name('sub-admin.add')->middleware('permission');
	Route::post('content', 'HomeController@contentAdd')->name('content.store')->middleware('permission');
	Route::get('/sub-admin/{id}/change-password', ['as'=>'sub.admin.cp','uses'=>'SubAdminController@changePassword'])->middleware('permission');	
	Route::post('/sub-admin/{id}/change-password', ['as'=>'sub.admin.cp.update','uses'=>'SubAdminController@updatePassword'])->middleware('permission');
});




