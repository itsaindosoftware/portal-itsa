<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();


Route::get('/home_', 'HomeController@home_')->name('dashboard');


Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('user', 'UserControllerManage');
    Route::resource('permission', 'PermissionController');
    Route::post('detach-permission/{role_id}', 'PermissionController@detachPermission')->name('permission.detach');
    Route::post('attach-permission/{role_id}', 'PermissionController@attachPermission')->name('permission.attach');
    Route::resource('role', 'RolesController');
    Route::resource('module', 'ModuleController');
    Route::resource('company', 'CompanyController');
    Route::resource('department', 'DepartmentController');
    Route::resource('position', 'PositionController');
    Route::resource('typereqform', 'TypereqformController');
    Route::resource('requestdar', 'RequestdarController');
    Route::get('view-document/{id}', 'RequestDarController@viewDocument')->name('requestdar.view-document');
    Route::get('/download-document/{id}', 'RequestdarController@downloadDocument')->name('requestdar.downloadDocument');
    Route::post('approved1/requestdar/{id}', 'RequestDarController@approvedBy1')->name('requestdar.approvedby1');
    Route::post('rejected1/requestdar/{id}', 'RequestDarController@rejectedAppr1')->name('requestdar.rejectedAppr1');
    Route::post('approved2/requestdar/{id}', 'RequestDarController@approvedBy2')->name('requestdar.approvedby2');
    Route::post('rejected2/requestdar/{id}', 'RequestDarController@rejectedAppr2')->name('requestdar.rejectedAppr2');
    Route::post('approved3/requestdar/{id}', 'RequestDarController@approvedBy3')->name('requestdar.approvedby3');
    Route::post('rejected3/requestdar/{id}', 'RequestDarController@rejectedAppr3')->name('requestdar.rejectedAppr3');

});
