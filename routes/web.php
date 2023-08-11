<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//Show Landing Page
Route::get('/', [
    UserController::class, 'index'
]);


//Show Loging Form
Route::get('/dashboard/login', [
    DashboardController::class, 'login'
])->name('login')->middleware('guest');;


//Log In Admin
Route::post('admin/authenticate', [
    UserController::class, 'authentificate'
]);

//Log Out Admin
Route::post('/admin/logout', [
    UserController::class, 'disconnect'
])->middleware('auth');


//Show Dashboard Page after logging in
Route::get('/dashboard', [
    DashboardController::class, 'dashboardLanding'
])->middleware('auth');

//Show Dashboard customizing template
Route::get('/dashboard/{templateName}?', [
    DashboardController::class, 'dashboardLanding'
])->middleware('auth');


//Show ViewMode Landing Page
Route::get('/view', [
    UserController::class, 'showLandingView'
]);

//Show A template
Route::get('/view/{templateName}', [
    UserController::class, 'showTemplateView'
]);


//Update the modified template
Route::post('/save-template/{templateName}', [
    DashboardController::class, 'saveTemplate'
]);




