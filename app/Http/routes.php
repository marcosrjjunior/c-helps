<?php

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'QuestionsController@index');

    Route::group(['prefix' => 'questions'], function () {
        Route::get('ask', ['as' => 'questions.ask', 'uses' => 'QuestionsController@ask']);
        Route::post('ask', ['as' => 'questions.submit', 'uses' => 'QuestionsController@submit']);
        Route::get('{id}', ['as' => 'questions.show', 'uses' => 'QuestionsController@show']);
        Route::get('{id}/edit', ['as' => 'questions.edit', 'uses' => 'QuestionsController@edit']);
        Route::put('{id}/update', ['as' => 'questions.update', 'uses' => 'QuestionsController@update']);
        Route::delete('{id}/delete', ['as' => 'questions.delete', 'uses' => 'QuestionsController@delete']);
        Route::get('tagged/{tag}', ['as' => 'questions.tagged', 'uses' => 'QuestionsController@byTag']);
    });

    Route::get('/search', ['as' => 'search', 'uses' => 'QuestionsController@search']);

    Route::group(['prefix' => 'answers'], function () {
        Route::post('submit', ['as' => 'answers.submit', 'uses' => 'AnswersController@submit']);
        Route::post('{id}/points/submit', ['as' => 'answers.points.submit', 'uses' => 'AnswersController@submitPoints']);
        Route::get('{id}/edit', ['as' => 'answers.edit', 'uses' => 'AnswersController@edit']);
        Route::put('{id}/update', ['as' => 'answers.update', 'uses' => 'AnswersController@update']);
        Route::delete('{id}/delete', ['as' => 'answers.delete', 'uses' => 'AnswersController@delete']);
    });

    Route::get('users/{id}', ['as' => 'users', 'uses' => 'UsersController@show']);
});

Route::get('auth/github', ['as' => 'auth.github', 'uses' => 'Auth\AuthController@redirectToProvider']);
Route::get('auth/github/callback', 'Auth\AuthController@handleProviderCallback');

Route::get('auth/login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@getLogin']);
Route::get('auth/logout', 'Auth\AuthController@getLogout');
