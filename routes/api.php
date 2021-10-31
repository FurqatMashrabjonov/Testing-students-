<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TestController;
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

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('profile', 'AuthController@profile');
});

Route::group(['middleware' => 'auth'], function (){

    Route::group(['prefix' => 'question'], function (){
        Route::get('/{test_id}', [QuestionController::class, 'index']);
        Route::post('/', [QuestionController::class, 'store']);
        Route::delete('/{quesion}', [QuestionController::class, 'destroy']);
        Route::post('/{question}', [QuestionController::class, 'update']);
    });


    Route::group(['prefix' => 'answer'], function (){
        Route::get('/{question_id}', [AnswerController::class, 'index']);
        Route::post('/', [AnswerController::class, 'store']);
        Route::delete('/{answer}', [AnswerController::class, 'destroy']);
        Route::post('/{answer}', [AnswerController::class, 'update']);
    });

    Route::group(['prefix' => 'test'], function (){
        Route::get('/', [TestController::class, 'index']);
        Route::post('/', [TestController::class, 'store']);
        Route::delete('/{test}', [TestController::class, 'destroy']);
        Route::post('/{test}', [TestController::class, 'update']);
        Route::get('/{token}', [TestController::class, 'withToken']);
        Route::get('/{id}/with_items', [TestController::class, 'getTestWithParams']);
        Route::post('/items/create', [TestController::class, 'storeItems']);

    });


});









