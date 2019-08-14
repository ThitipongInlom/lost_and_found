<?php
// Dashboard
Route::get('/', 'dashboard@dashboard')->middleware('auth');
// Print
Route::get('/print/{item_id}', 'dashboard@print_item');
// Login
Route::get('/login', 'systemlogin@login_page')->name('login');
// Register
Route::get('/register', 'systemlogin@register_page')->name('register');
// Setting User
Route::get('/setting_user', 'setting_user@setting_user_page')->name('setting_user');
// Setting Type
Route::get('/setting_type', 'setting_type@setting_type_page');
// Logout
Route::get('/logout', 'systemlogin@logout');
// Switch Lang
Route::get('/switch_lang', 'systemlogin@switch_lang');
// API ต่างๆ
Route::group(['prefix' => 'api/v1'], function () {
    Route::get('/get_type', 'dashboard@get_type');
    Route::get('/get_user', 'setting_user@get_user_all');
    Route::get('/get_type_setting', 'setting_type@get_type_all');
    Route::post('/return_item', 'dashboard@return_item');
    Route::post('/save_add', 'dashboard@save_add');
    Route::post('/edit_item', 'dashboard@edit_item');
    Route::post('/save_edit', 'dashboard@save_edit');
    Route::post('/view_item', 'dashboard@view_item');
    Route::post('/delete_item', 'dashboard@delete_item');
    Route::post('/delete_img', 'dashboard@delete_img');
    Route::post('/do_login', 'systemlogin@do_login');
    Route::post('/do_register', 'systemlogin@do_register');
});
