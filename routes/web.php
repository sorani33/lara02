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
})->name('top');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function() {
    //問題
    Route::get('sample/{genre_id?}', 'PracticeController@index')->name('sample');
    Route::post('result', 'PracticeController@result');

    //マイページ
    Route::get('mypage', 'MypageController@index')->name('mypage');
    Route::get('mypage/editName', 'MypageController@editName')->name('mypage.editname');
    Route::post('mypage/editName/save', 'MypageController@editNameSave')->name('mypage.editname.save');
    Route::get('mypage/editTitle', 'MypageController@editTitle')->name('mypage.edittitle');
    Route::post('mypage/editTitle/save', 'MypageController@editTitleSave')->name('mypage.edittitle.save');

});