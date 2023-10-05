<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

    
});

//Show all the Templates names in the folder resources/views/dashboard/templates
Route::get('/templates/get', [
    DashboardController::class, 'showTemplatesNames'
]);

//Show the innerHTML of a Template 
Route::get('/templates/getByName/{name}', [
    DashboardController::class, 'showTemplateByName'
]);

//POST the innerHTML of a Template and update it
Route::post('/templates', [
    DashboardController::class, 'updateTemplateByName'
]);

////////////////////////////////////////////////////////////////////////////////
//                      API working the DB method                             //
////////////////////////////////////////////////////////////////////////////////

//Show all the Templates in the DB
Route::get('/templates/getFromDB', [
    DashboardController::class, 'getAllTemplatesList'
]);

//Get the content of a Template in a string and width/height dimensions
Route::get('/templates/{id}', [
    DashboardController::class, 'showTemplateXdimensionById'
]);

//Show all The Elements Of a Template By Id
Route::get('/templates/{id}/elements/get', [
    DashboardController::class, 'getElementsOfTemplateById'
]);

//Update Style of Element By Id
Route::put('/element/update/{element_id}', [
    DashboardController::class, 'updateStyleElementById'
]);

//update the content of an Existing Element By Id
Route::put('/element/updateContent/{element_id}', [
    DashboardController::class, 'updateContentElementById'
]);

//add New Element
Route::post('/elements/create', [
    DashboardController::class, 'createNewElement'
]);

//Make an Element Visible (changing the value of the hidden to 0)
Route::put('element/makeVisible/{element_id}', [
    DashboardController::class, 'makeElementVisibleById'
]);

//Make an Element Hidden (changing to value of the hidden to 1)
Route::put('element/makeHidden/{element_id}', [
    DashboardController::class, 'makeElementHiddenById'
]);

//Delete an Element From a Template
Route::delete('element/deleteElement/{element_id}', [
    DashboardController::class, 'destroyElement'
]);

//Get all the Dimensions disponibles
Route::get('dimension/getAll', [
    DashboardController::class, 'showAllDimensions'
]);

//Update Dimension of a Template
Route::put('template/{template_id}/updateDim', [
    DashboardController::class, 'updateTemplateDimension'
]);

//Add a new Dimension #####IN PROGRESSS #####
Route::post('dimension/create', [
    DashboardController::class, 'createNewDimension'
]);

//Upload file 
Route::post('upload/logo', [
    DashboardController::class, 'uploadLogo'
]);

//Add a new Logo to a Template
Route::post('logo/upload', [
    DashboardController::class, 'uploadNewLogo'
]);

//Get the Logo infos By Id 
Route::get('logo/getData/{logo_id}', [
    DashboardController::class, 'getLogoDataById'
]);

//Get the Logo File
Route::get('logo/getFile/{logo_id}', [
    DashboardController::class, 'getLogoFileById'
]);

Route::put('logo/update/{logo_id}', [
    DashboardController::class, 'updateLogoById'
]);

