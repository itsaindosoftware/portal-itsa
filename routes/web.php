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
    // :: ADMIN ::
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

});
