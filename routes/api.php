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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('login/twitter', 'Auth\LoginController@redirectToTwitterProvider');
Route::get('login/twitter/callback', 'Auth\LoginController@handleTwitterProviderCallback');

Route::namespace('API')->group(function(){
    Route::get('/examinationquestions', 'ExaminationQuestionController@index');
    Route::get('/examinationquestions/{id}', 'ExaminationQuestionController@show');
    Route::post('/result', 'ExaminationQuestionController@result');

});
    // Route::get('/examinationquestions', 'API\ExaminationQuestionController@index');


