<?php
Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('roles', 'RoleController');
    Route::resource('users', 'UserController');
    Route::resource('products', 'ProductController');
    Route::resource('chart', 'ChartController');
    Route::resource('keloladata', 'KelolaDataController');
    Route::post('import', 'KelolaDataController@import')->name('import');
    Route::resource('kelolaaom', 'KelolaAomController');

});
