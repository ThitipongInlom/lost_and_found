<?php
// Dashboard
Route::get('/', 'dashboard@dashboard')->middleware('auth');
// Print
Route::get('/print/{item_id}', 'dashboard@print_item');
// Report
Route::get('/report', 'report@report')->name('report');
// Login
Route::get('/login', 'systemlogin@login_page')->name('login');
// Register
Route::get('/register', 'systemlogin@register_page')->name('register');
// Setting User
Route::get('/setting_user', 'setting_user@setting_user_page')->name('setting_user');
// Setting Type
Route::get('/setting_type', 'setting_type@setting_type_page')->name('setting_type');
// Setting Web
Route::get('/setting_web', 'setting_web@setting_web_page')->name('setting_web');
// Logout
Route::get('/logout', 'systemlogin@logout');
// Switch Lang
Route::get('/switch_lang', 'systemlogin@switch_lang');
// API ต่างๆ
Route::group(['prefix' => 'api/v1'], function () {
    Route::get('/get_type', 'dashboard@get_type');
    Route::get('/get_user', 'setting_user@get_user_all');
    Route::get('/get_type_setting', 'setting_type@get_type_all');
    Route::get('/get_place_setting', 'setting_type@get_place_all');
    Route::post('/get_edit_user_id', 'setting_user@get_edit_user_id');
    Route::post('/save_edit_user', 'setting_user@save_edit_user');
    Route::post('/save_show_type', 'setting_type@save_show_type');
    Route::post('/delete_type', 'setting_type@delete_type');
    Route::post('/save_type', 'setting_type@save_type');
    Route::post('/edit_type', 'setting_type@edit_type');
    Route::post('/return_item', 'dashboard@return_item');
    Route::post('/save_retuen', 'dashboard@Save_return_item');
    Route::post('/save_add', 'dashboard@save_add');
    Route::post('/edit_item', 'dashboard@edit_item');
    Route::post('/save_edit', 'dashboard@save_edit');
    Route::post('/view_item', 'dashboard@view_item');
    Route::post('/delete_item', 'dashboard@delete_item');
    Route::post('/delete_img', 'dashboard@delete_img');
    Route::post('/do_login', 'systemlogin@do_login');
    Route::post('/do_register', 'systemlogin@do_register');
    Route::post('/background_web', 'setting_web@background_web');
    Route::post('/icon_web', 'setting_web@icon_web');
    Route::post('/save_resetpw', 'setting_user@save_resetpw');
    Route::post('/delete_user', 'setting_user@delete_user');
    Route::post('/get_tab_1', 'report@get_tab_1');
});
