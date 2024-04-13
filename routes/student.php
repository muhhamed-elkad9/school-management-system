<?php

use App\Http\Controllers\students\AddImageStudentsController;
use App\Http\Controllers\students\ExamsController;
use App\Http\Controllers\students\ProfileStudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| student Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//==============================Translate all pages============================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:student']
    ],
    function () {

        //==============================dashboard============================
        Route::get('/student/dashboard', function () {
            return view('students.dashboard');
        });

        Route::group(['prefix' => 'exam'], function () {
            //==============================students============================
            Route::get('index', [ExamsController::class, 'index'])->name('exam.index');
            Route::get('show/{id}', [ExamsController::class, 'show'])->name('exam.show');
        });


        Route::group(['prefix' => 'profileStudent'], function () {
            //==============================students============================
            Route::get('index', [ProfileStudentController::class, 'index'])->name('profileStudent.index');
            Route::post('update/{id}', [ProfileStudentController::class, 'update'])->name('profileStudent.update');
        });


        Route::post('/StudentImage', [AddImageStudentsController::class, 'update'])->name('StudentImage.update');
    }
);
