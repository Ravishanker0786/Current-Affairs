<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controller\NewsController;
use App\Http\Controller\TopicController;
use App\Http\Controller\QuizController;
use App\Http\Controller\LoginController;

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
})->name('login');


Route::get('/news', function () {
    return view('news');
});

Route::get('/quiz', function () {
    return view('quiz');
});

Route::get('/insight', function () {
    return view('insight');
});


Route::get('/topics', function () {
    return view('topics');
});




Route::group(['prefix' => '/admin', 'middleware' => 'auth:web'], function()
{

    //news
    Route::get('/news/get','NewsController@index')->name('news');
    Route::post('/news/store','NewsController@store')->name('news.store');

    //topic
    Route::get('/topic/get','TopicController@index')->name('topic');
    Route::post('/topic/store','TopicController@store')->name('topic.store');

    //topic
    Route::get('/insight/get','InsightController@index')->name('insight');
    Route::post('/insight/store','InsightController@store')->name('insight.store');
    Route::get('/insight/create','InsightController@create')->name('insight.create');


    //quiz
    Route::get('/quiz/get','QuizController@index')->name('quiz');
    Route::post('/quiz/store','QuizController@store')->name('quiz.store');
    Route::get('/quiz/create','QuizController@create')->name('quiz.create');

    Route::get('/dashboard','LoginController@after_login')->name('welcome');

});

Route::get('/logout','LoginController@logout')->name('logout');
Route::post('/login','LoginController@check_login')->name('check_login');

Route::post('/admin/checklogin','LoginController@checklogin');
