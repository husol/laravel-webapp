<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'HomeController@index');
Route::get('/thongbao/{id}', 'HomeController@notification');
Route::post('/ajax', 'AjaxController@index');

Route::get('/dangnhap', 'LoginController@index');
Route::post('/kiemtrataikhoan', array('uses' => 'LoginController@doLogIn'));
Route::get('/dangxuat', 'LoginController@doLogout');

Route::get('/danhmuc', 'ArticleController@getList');

Route::get('/quantri', 'ManagementController@show');

Route::get('/chiase', 'ShareController@show');
Route::post('/themchiase', 'ShareController@save');
Route::get('/xoachiase/{id}', 'ShareController@delete');

Route::get('/baocao', 'ReportController@show');

Route::get('/danhmuc', 'CategoryController@show');

Route::get('/phanquyen', 'RoleController@show');

Route::get('/nhanxet', 'CommentController@show');

Route::get('/tonghop', 'GeneralController@show');
Route::get('/taibaocao', 'GeneralController@download');

Route::get('/cauhoi', 'QuestionaireController@show');
Route::post('/themcauhoi', 'QuestionaireController@save');
Route::get('/xoacauhoi/{id}', 'QuestionaireController@delete');

Route::get('/doanhnghiep', 'CompanyController@show');
Route::post('/themdoanhnghiep', 'CompanyController@save');
Route::get('/xoadoanhnghiep/{id}', 'CompanyController@delete');

Route::post('/themnguoidung', 'UserController@save');
Route::get('/xoanguoidung/{id}', 'UserController@delete');
Route::post('/suathongtin', 'UserController@saveProfile');

Route::post('/themthongbao', 'NotifController@save');
Route::get('/xoathongbao/{id}', 'NotifController@delete');

Route::post('/themminhchung', 'ProofController@save');
Route::get('/xoaminhchung/{id}', 'ProofController@delete');

Route::post('/themtieuchuan', 'ArticleController@saveStandard');
Route::get('/xoatieuchuan/{id}', 'ArticleController@deleteStandard');

Route::post('/themtieuchi', 'ArticleController@saveCriteria');
Route::get('/xoatieuchi/{id}', 'ArticleController@deleteCriteria');
