<?php
// Dashboard
Route::get('/', 'dashboard@dashboard')->middleware('auth');
// Print
Route::get('/print/{item_id}', 'dashboard@print_item');
// Login
Route::get('/login', 'systemlogin@login_page')->name('login');
// Register
Route::get('/register', 'systemlogin@register_page')->name('register');
// Logout
Route::get('/logout', 'systemlogin@logout');
// API ต่างๆ
Route::group(['prefix' => 'api/v1'], function () {
    Route::get('/get_type', 'dashboard@get_type');
    Route::post('/save_add', 'dashboard@save_add');
    Route::post('/edit_item', 'dashboard@edit_item');
    Route::post('/save_edit', 'dashboard@save_edit');
    Route::post('/view_item', 'dashboard@view_item');
    Route::post('/delete_item', 'dashboard@delete_item');
    Route::post('/delete_img', 'dashboard@delete_img');
    Route::post('/do_login', 'systemlogin@do_login');
    Route::post('/do_register', 'systemlogin@do_register');
});
