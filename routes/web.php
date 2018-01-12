<?php



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function(){

    Route::resource('channels', 'channelsController');

    Route::get('/profiles/{slug}', [
        'uses' => 'profilesController@index',
        'as' => 'profile'
    ]);

});

Route::get('/profiles/edit/profile', [
    'uses' => 'profilesController@edit',
    'as' => 'profile.edit'
]);

Route::post('/profiles/update/profile', [
    'uses' => 'profilesController@update',
    'as' => 'profile.update'
]);

Route::get('/check_relationship/{id}', [
    'uses' => 'FriendsController@check',
    'as' => 'check'
]);

Route::get('/add_friend/{id}', [
    'uses' => 'FriendsController@add_friend',
    'as' => 'add_friend'
]);

