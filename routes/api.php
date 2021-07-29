<?php

use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::group(['middleware'=>'auth:api'], function(){
    Route::get('/user', [AuthController::class, 'me']);
    Route::post('/logout',[AuthController::class, 'logout']);

    Route::post('/applicants/search', [ApplicantController::class, 'search']);
    Route::post('/applicants', [ApplicantController::class, 'store']);
    Route::get('/applicants', [ApplicantController::class, 'index']);
    Route::get('/applicants/{applicant}', [ApplicantController::class, 'show']);
    Route::put('/applicants/{applicant}', [ApplicantController::class, 'update']);
    Route::delete('/applicants/{applicant}', [ApplicantController::class, 'destroy']);
});
