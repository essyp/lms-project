<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\GradeController;

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

Route::get('/', [DashboardController::class, "fetchData"]);
Route::get('/home', [DashboardController::class, "fetchData"]);

Route::group(['middleware' => ['web'], 'prefix' => 'student/'], function () {
    Route::get('/history', [StudentController::class, "fetchData"]);    
    Route::post('/import/edit', [StudentController::class, "editData"]);
    Route::post('/export', [StudentController::class, "exportData"]);
    Route::get('/home', [StudentController::class, "fetchData"]);
    Route::post('/import', [StudentController::class, "importData"]);
    Route::post('/import-edited-data', [StudentController::class, "importEditedData"]);
    Route::get('/download-template', [StudentController::class, "downloadTemplate"]);
    Route::post('/bulk-action', [StudentController::class, "bulkAction"]);
    Route::post('/update-data', [StudentController::class, "updateData"]);
    Route::post('/create-data', [StudentController::class, "createData"]);
});

Route::group(['middleware' => ['web'], 'prefix' => 'enrollment/'], function () {
    Route::get('/student', [EnrollmentController::class, "fetchData"]);
    Route::get('/staff', [EnrollmentController::class, "fetchStaffData"]);
    Route::post('/import/edit', [EnrollmentController::class, "editData"]);
    Route::post('/export', [EnrollmentController::class, "exportData"]);
    Route::post('/export-staff', [EnrollmentController::class, "exportStaffData"]);
    Route::get('/home', [EnrollmentController::class, "fetchData"]);
    Route::post('/import', [EnrollmentController::class, "importData"]);
    Route::post('/import-edited-data', [EnrollmentController::class, "importEditedData"]);
    Route::get('/download-template', [EnrollmentController::class, "downloadTemplate"]);
    Route::post('/bulk-action', [EnrollmentController::class, "bulkAction"]);
    Route::post('/update-data', [EnrollmentController::class, "updateData"]);
    Route::post('/create-data', [EnrollmentController::class, "createData"]);
});

Route::group(['middleware' => ['web'], 'prefix' => 'staff/'], function () {
    Route::get('/history', [StaffController::class, "fetchData"]);
    Route::post('/import/edit', [StaffController::class, "editData"]);
    Route::post('/export', [StaffController::class, "exportData"]);
    Route::get('/home', [StaffController::class, "fetchData"]);
    Route::post('/import', [StaffController::class, "importData"]);
    Route::post('/import-edited-data', [StaffController::class, "importEditedData"]);
    Route::get('/download-template', [StaffController::class, "downloadTemplate"]);
    Route::post('/bulk-action', [StaffController::class, "bulkAction"]);
    Route::post('/update-data', [StaffController::class, "updateData"]);
    Route::post('/create-data', [StaffController::class, "createData"]);
});

Route::group(['middleware' => ['web'], 'prefix' => 'setting/'], function () {
    Route::get('/school-setting', [SettingController::class, "fetchData"]);
    Route::get('/grade-setting', [SettingController::class, "fetchGrades"]);
    Route::post('/create', [SettingController::class, "createData"]);
    Route::post('/update', [SettingController::class, "updateData"]);
    Route::post('/create-grade', [SettingController::class, "createGrade"]);
    Route::post('/update-grade', [SettingController::class, "updateGrade"]);
    Route::post('/grade-bulk-action', [SettingController::class, "gradeBulkAction"]);
});

Route::group(['middleware' => ['web'], 'prefix' => 'class/'], function () {
    Route::get('/groups', [ClassController::class, "fetchData"]);    
    Route::post('/create', [ClassController::class, "createData"]);
    Route::post('/update', [ClassController::class, "updateData"]);
    Route::post('/bulk-action', [ClassController::class, "bulkAction"]);
});

Route::group(['middleware' => ['web'], 'prefix' => 'course/'], function () {
    Route::get('/history', [CourseController::class, "fetchData"]);    
    Route::post('/create', [CourseController::class, "createData"]);
    Route::post('/update', [CourseController::class, "updateData"]);
    Route::post('/bulk-action', [CourseController::class, "bulkAction"]);
});

Route::group(['middleware' => ['web'], 'prefix' => 'grade/'], function () {
    Route::get('/export', [GradeController::class, "exportData"]);
});