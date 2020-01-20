<?php

Route::get('/', 'TaskController@index')->name('task.index');
Route::get('/task/edit/{id}', 'TaskController@edit')->name('task.edit');
Route::post('/task/store', 'TaskController@store')->name('task.store');
Route::post('/task/update/{id}', 'TaskController@update')->name('task.update');
Route::post('/task/delete/{id}', 'TaskController@destroy')->name('task.destroy');
