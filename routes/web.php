<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\fe\AboutController;
use App\Http\Controllers\fe\ServiceController;
use App\Http\Controllers\fe\ContactController;
use App\Http\Controllers\fe\BerandaController;
use App\Http\Controllers\fe\NewsController;

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


Route::get('/', [BerandaController::class, 'index'])->name('home');

// Route::get('/login-digitalassets', function () {
//     return view('auth.login-da');
// });

// :: FRONT END :: //
Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/service', [ServiceController::class, 'index'])->name('service');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');

Route::get('/home_', 'HomeController@home_')->name('dashboard');

Auth::routes();

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
    Route::resource('newsbe', 'NewsbeController');
    Route::resource('servicebe', 'ServicebeController');
    Route::resource('digitalassets', 'DigitalassetsController');

});
