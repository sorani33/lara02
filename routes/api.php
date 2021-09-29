<?php

use Illuminate\Http\Request;

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
// Route::get('login/twitter', 'Auth\LoginController@redirectToTwitterProvider');
// // Route::get('api/login/twitter', 'Auth\LoginController@redirectToTwitterProvider');
// Route::get('login/twitter/callback', 'Auth\LoginController@handleTwitterProviderCallback');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::namespace('API')->group(function(){
    Route::get('/home', 'ExaminationQuestionController@home');
    Route::get('/report/{modeId}', 'ReportController@index');
    Route::get('/examinationquestions', 'ExaminationQuestionController@index');
    Route::get('/examinationquestions/{id}', 'ExaminationQuestionController@show');
    Route::post('/result', 'ExaminationQuestionController@result');
    Route::get('/mypage/edit', 'MypageController@edit');
    Route::put('/mypage/edit', 'MypageController@editUpdate');

});
    // Route::get('/examinationquestions', 'API\ExaminationQuestionController@index');


