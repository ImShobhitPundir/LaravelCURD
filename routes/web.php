<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you candgdfg register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
 
Route::resource('category', 'CategoryController');
Route::resource('subcategory', 'SubCategoryController');
Route::resource('product', 'ProductController');
Route::post('/ajax-subcat', 'ProductController@getSubCategory');
