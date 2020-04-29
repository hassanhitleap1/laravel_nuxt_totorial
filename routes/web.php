<?php
Route::post('/login','LoginController@index');
Route::post('/register','RegistrarController@index');
Route::get('/user','LoginController@user');
Route::post('/user','LoginController@user');
