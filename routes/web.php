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
    Route::get('profile', 'HomeController@profile')->name('profile');
    Route::resource('user', 'UserControllerManage');
    Route::resource('permission', 'PermissionController');
    Route::post('detach-permission/{role_id}', 'PermissionController@detachPermission')->name('permission.detach');
    Route::post('attach-permission/{role_id}', 'PermissionController@attachPermission')->name('permission.attach');
    Route::resource('role', 'RolesController');
    Route::resource('module', 'ModuleController');
    Route::resource('company', 'CompanyController');
    Route::resource('department', 'DepartmentController');
    Route::resource('position', 'PositionController');

    // :: Document Action Request ( DAR)::
    Route::resource('typereqform', 'TypereqformController');
    Route::resource('requestdar', 'RequestdarController');
    Route::get('view-document/{param}', 'RequestDarController@viewDocument')->name('requestdar.view-document');
    Route::get('/download-document/{param}', 'RequestdarController@downloadDocument')->name('requestdar.downloadDocument');
    Route::post('approved1/requestdar/{param}', 'RequestDarController@approvedBy1')->name('requestdar.approvedby1');
    Route::post('rejected1/requestdar/{param}', 'RequestDarController@rejectedAppr1')->name('requestdar.rejectedAppr1');
    Route::post('approved2/requestdar/{param}', 'RequestDarController@approvedBy2')->name('requestdar.approvedby2');
    Route::post('rejected2/requestdar/{param}', 'RequestDarController@rejectedAppr2')->name('requestdar.rejectedAppr2');
    Route::post('approved3/requestdar/{param}', 'RequestDarController@approvedBy3')->name('requestdar.approvedby3');
    Route::post('rejected3/requestdar/{param}', 'RequestDarController@rejectedAppr3')->name('requestdar.rejectedAppr3');
    Route::resource('newsbe', 'NewsbeController');
    Route::resource('servicebe', 'ServicebeController');

    // :: Digital Assets Registration ( Registration Fixed Assets)::
    Route::resource('digitalassets', 'DigitalassetsController');
    Route::post('digitalassets/approved1/{param}', 'DigitalassetsController@approvedBy1')->name('digitalassets.approvedby1');
    Route::post('digitalassets/approved2/{param}', 'DigitalassetsController@approvedBy2')->name('digitalassets.approvedby2');
    Route::post('digitalassets/rejected2/{param}', 'DigitalassetsController@rejectedAppr2')->name('digitalassets.rejectedAppr2');
    Route::post('digitalassets/approved3/{param}', 'DigitalassetsController@approvedBy3')->name('digitalassets.approvedby3');
    Route::post('digitalassets/rejected3/{param}', 'DigitalassetsController@rejectedAppr3')->name('digitalassets.rejectedAppr3');
    // Route::get('digitalassets/index-dashboard-sendnotif', 'DigitalassetsController@indexDashboardSendNotif')->name('digitalassets.indexDashboard');

    Route::get('/apps', [App\Http\Controllers\AppController::class, 'index'])->name('apps.index');

    //  // :: Asset Transfer Notification ::
    Route::resource('transfernotif', 'AssettfnotifController');
    Route::get('transfernotif/sendingNotif/{param}', 'AssettfnotifController@send')->name('transfernotif.send');
    Route::get('transfernotif/exportpdf/{param}', 'AssettfnotifController@send')->name('transfernotif.export');
    Route::get('view-document/{param}', 'AssettfnotifController@viewDocument')->name('transfernotif.viewDocs');
});
