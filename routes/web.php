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
Route::get('/demo', function () {
    return view('demo');
})->name('demo');

Route::get('/', function () {
    return view('welcome');
})->name('top');

Route::get('login/twitter', 'Auth\LoginController@redirectToTwitterProvider')->name('twitter.login');
// Route::get('api/login/twitter', 'Auth\LoginController@redirectToTwitterProvider');
Route::get('login/twitter/callback', 'Auth\LoginController@handleTwitterProviderCallback');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function() {
    //問題
    Route::get('sample/{genre_id?}', 'PracticeController@index')->name('sample');
    Route::post('result', 'PracticeController@result');

    //マイページ
    // Route::get('mypage', 'MypageController@index')->name('mypage');
    // Route::get('mypage/editName', 'MypageController@editName')->name('mypage.editname');
    // Route::post('mypage/editName/save', 'MypageController@editNameSave')->name('mypage.editname.save');
    // Route::get('mypage/editTitle', 'MypageController@editTitle')->name('mypage.edittitle');
    // Route::post('mypage/editTitle/save', 'MypageController@editTitleSave')->name('mypage.edittitle.save');

});