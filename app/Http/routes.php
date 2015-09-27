<?php

Route::get('/', 'QuestionsController@index');

Route::group(['prefix' => 'questions'], function () {
    Route::get('ask', 'QuestionsController@ask');
    Route::post('ask', ['as' => 'questions.submit', 'uses' => 'QuestionsController@submit']);
    Route::get('{id}', ['as' => 'questions.show', 'uses' => 'QuestionsController@show']);
});

Route::group(['prefix' => 'answers'], function () {
    Route::post('submit', ['as' => 'answers.submit', 'uses' => 'AnswersController@submit']);
    Route::post('{id}/points/submit', ['as' => 'answers.points.submit', 'uses' => 'AnswersController@submitPoints']);
});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
