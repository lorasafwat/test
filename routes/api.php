<?php

use App\Http\Controllers\FormPatientController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ApiAuth;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

///////////////login//////////////////
Route::post('rec/login',[LoginController::class,'loginRec']);

Route::post('patient/login',[LoginController::class,'loginPatient']);

Route::post('dr/login',[LoginController::class,'loginDoctor']);

/////////////////form patient///////////////////
Route::post('patient/register',[FormPatientController::class,'register']);

Route::put('patient/update/{id}',[FormPatientController::class,'updatePatient']);

Route::delete('patient/delete/{id}',[FormPatientController::class,'deletePatient']);

Route::get('patient/getdata',[FormPatientController::class,'getPatient']);