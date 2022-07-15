<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'as' => 'v1.' ], function () {
    Route::post('auth/login', [App\Http\Controllers\Api\AuthController::class, 'login']);
    Route::post('auth/forgot-password', [App\Http\Controllers\Api\AuthController::class, 'forgotPassword']);
    Route::post('auth/reset-password', [App\Http\Controllers\Api\AuthController::class, 'resetPassword']);
    Route::middleware('auth:api')->post('auth/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
    Route::middleware('auth:api')->post('auth/change-password', [App\Http\Controllers\Api\AuthController::class, 'changePassword']);
    Route::middleware('auth:api')->get('auth/user', [App\Http\Controllers\Api\AuthController::class, 'user']);

    Route::apiResource('patients', App\Http\Controllers\Api\PatientController::class);
    Route::apiResource('patient/relationships', App\Http\Controllers\Api\PatientRelationshipController::class);
    Route::apiResource('medical-staff', App\Http\Controllers\Api\MedicalStaffController::class);
    Route::apiResource('clinics', App\Http\Controllers\Api\ClinicController::class);
    Route::apiResource('references', App\Http\Controllers\Api\ReferenceController::class);
    Route::apiResource('parameters', App\Http\Controllers\Api\ParameterController::class);
    Route::apiResource('diagnoses', App\Http\Controllers\Api\DiagnosisController::class);
    Route::apiResource('family-planning-categories', App\Http\Controllers\Api\FamilyPlanningCategoryController::class);
    Route::apiResource('work-accident-categories', App\Http\Controllers\Api\WorkAccidentCategoryController::class);

    Route::group(['prefix' => 'letter/', 'as' => 'letter.' ], function () {
        Route::get('references/send-to-email/{id}', [App\Http\Controllers\Api\Letter\ReferenceLetterController::class, 'sendToEmail']);
        Route::apiResource('references', App\Http\Controllers\Api\Letter\ReferenceLetterController::class);
        Route::get('sicks/send-to-email/{id}', [App\Http\Controllers\Api\Letter\SickLetterController::class, 'sendToEmail']);
        Route::apiResource('sicks', App\Http\Controllers\Api\Letter\SickLetterController::class);
    });

    Route::group(['prefix' => 'registration/', 'as' => 'registration.' ], function () {
        Route::apiResource('plano-tests', App\Http\Controllers\Api\Registration\PlanoTestController::class);
        Route::apiResource('family-plannings', App\Http\Controllers\Api\Registration\FamilyPlanningController::class);
        Route::apiResource('outpatients', App\Http\Controllers\Api\Registration\OutpatientController::class);
        Route::apiResource('work-accidents', App\Http\Controllers\Api\Registration\WorkAccidentController::class);
    });

    Route::group(['prefix' => 'action/', 'as' => 'action.' ], function () {
        Route::apiResource('plano-tests', App\Http\Controllers\Api\Action\PlanoTestController::class);
        Route::apiResource('family-plannings', App\Http\Controllers\Api\Action\FamilyPlanningController::class);
        Route::apiResource('outpatients', App\Http\Controllers\Api\Action\OutpatientController::class);
        Route::apiResource('work-accidents', App\Http\Controllers\Api\Action\WorkAccidentController::class);
    });
});
