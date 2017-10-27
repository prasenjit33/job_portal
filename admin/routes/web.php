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
    return view('login');
});

/*
 * Login & Profile
 */
Route::post('login', 'LoginController@login');
Route::get('dashboard', 'LoginController@dashboard');
Route::get('logout', 'LoginController@logout');

//Home Section
Route::get('top-slider', 'HomeController@index');
Route::post('UploadTopSectionImage', 'HomeController@UploadTopSectionImage');

//Location Section
Route::get('country', 'LocationController@GetCountries');
Route::get('AjaxGetAllCountries', 'LocationController@AjaxGetAllCountries');
Route::get('add-country', 'LocationController@AddCountry');
Route::post('AjaxSaveCountry', 'LocationController@AjaxSaveCountry');
Route::post('AjaxGetCountryByID', 'LocationController@AjaxGetCountryByID');
Route::post('AjaxTrashCountry', 'LocationController@AjaxTrashCountry');
Route::get('AjaxGetAllTrashedCountries', 'LocationController@AjaxGetAllTrashedCountries');
Route::post('AjaxDeleteCountryByCountrySlug', 'LocationController@AjaxDeleteCountryByCountrySlug');
Route::post('AjaxRestoreCountryByCountrySlug', 'LocationController@AjaxRestoreCountryByCountrySlug');
