<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\HandlerController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\StimulsoftController;

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
    return view('welcome');
});

Auth::routes();
Route::post('/register_ajax',       [App\Http\Controllers\Auth\RegisterController::class,       'register_ajax'])->name('register_ajax');
Route::post('/login_ajax',          [App\Http\Controllers\Auth\LoginController::class,          'login_ajax'])->name('login_ajax');
Route::post('/password/email_ajax', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'email_ajax'])->name('password.email_ajax');
Route::post('/password/reset_ajax', [App\Http\Controllers\Auth\ResetPasswordController::class,  'reset_ajax'])->name('password.reset_ajax');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');



Route::get('/change-password', [App\Http\Controllers\ProfileController::class, 'change_password'])->name('change_password')->middleware('verified');
Route::post('/update-password', [App\Http\Controllers\ProfileController::class, 'update_password'])->name('update_password');

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'profile'])->name('profile')->middleware('auth');
Route::post('/profile_ajax', [App\Http\Controllers\ProfileController::class, 'profile_ajax'])->name('profile_ajax')->middleware('auth');
Route::post('/profile_image', [App\Http\Controllers\ProfileController::class, 'profile_image'])->name('profile_image')->middleware('auth');

Route::get('/test/generate-pdf', [App\Http\Controllers\Test\PDFController::class, 'generatePDF']);
Route::get('/test/generate-docx', [App\Http\Controllers\Test\DocxController::class, 'generateDocx']);
Route::get('/test/generate-xlsx', [App\Http\Controllers\Test\XlsxController::class, 'generateXlsx']);

//Route::get('/personas', [App\Http\Controllers\PersonaController::class, 'index'])->name('persona.index')->middleware('auth');
// Route::post('/persona/store', [App\Http\Controllers\PersonaController::class, 'store'])->name('persona.store')->middleware('auth');
// Route::get('/persona/fetchall', [App\Http\Controllers\PersonaController::class, 'fetchAll'])->name('persona.fetchAll');
// Route::delete('/personas/delete', [App\Http\Controllers\PersonaController::class, 'delete'])->name('persona.delete');
// Route::get('/personas/edit', [App\Http\Controllers\PersonaController::class, 'edit'])->name('persona.edit');
// Route::post('/personas/update', [App\Http\Controllers\PersonaController::class, 'update'])->name('persona.update');

Route::group (['middleware' => ['auth']], function () {
    // Users
    Route::get('/users/datatable',[UserController::class,'datatable'])->name('users.datatable');
    Route::resource('/users', UserController::class)->names("users");

    // Personas
    Route::get('/personas/datatable',[PersonaController::class,'datatable'])->name('personas.datatable');
    Route::get('/personas/{id}/audits',[PersonaController::class,'audits'])->name('personas.audits');
    Route::get('/personas/report',[PersonaController::class,'report'])->name('personas.report');
    Route::resource('/personas', PersonaController::class)->names("personas");

    // Roles
    Route::get('/roles/datatable',[RoleController::class,'datatable'])->name('roles.datatable');
    Route::get('/roles/{id}/audits',[RoleController::class,'audits'])->name('roles.audits');
    Route::resource('/roles', RoleController::class)->names("roles");

    // Permissions
    Route::get('/permissions/datatable',[PermissionController::class,'datatable'])->name('permissions.datatable');
    Route::get('/permissions/{id}/audits',[PermissionController::class,'audits'])->name('permissions.audits');
    Route::resource('/permissions', PermissionController::class)->names("permissions");
});


Route::get('/viewer', [ReportController::class, 'viewer']);
Route::any('/handler', [HandlerController::class, 'process']);


Route::get('/stimulviewer1', [StimulsoftController::class, 'stimulviewer1']);
Route::get('/test1', function (){
    return 'HolA';
});
Route::get('/reports', [ReportController::class, 'showReport']);
