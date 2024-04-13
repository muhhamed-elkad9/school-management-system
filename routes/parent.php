<?php

use App\Http\Controllers\parents\AddImageParentsController;
use App\Http\Controllers\parents\ProfileParentController;
use App\Http\Controllers\parents\SonsController;
use App\Models\My_Parent;
use App\Models\Student;
use Illuminate\Http\Request;
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
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:parent']
    ],
    function () {

        //==============================dashboard============================
        Route::get('/parent/dashboard', function () {
            $sons = Student::where('parent_id', auth()->user()->id)->get();
            return view('parents.dashboard', compact('sons'));
        })->name('dashboard.parents');

        Route::group(['prefix' => 'sons'], function () {
            //==============================students============================
            Route::get('index', [SonsController::class, 'index'])->name('sons.index');
            Route::get('results/{id}', [SonsController::class, 'results'])->name('sons.results');
            Route::get('attendances', [SonsController::class, 'attendances'])->name('sons.attendances');
            Route::post('attendances_Search', [SonsController::class, 'attendances_Search'])->name('sons.attendance.search');
            Route::get('fees', [SonsController::class, 'fees'])->name('sons.fees');
            Route::get('receipt/{id}', [SonsController::class, 'receipt'])->name('sons.receipt');
        });

        Route::group(['prefix' => 'profileParent'], function () {
            //==============================students============================
            Route::get('index', [ProfileParentController::class, 'index'])->name('profileParent.index');
            Route::post('update/{id}', [ProfileParentController::class, 'update'])->name('profileParent.update');
        });

        Route::post('/ParentsImage', [AddImageParentsController::class, 'update'])->name('ParentsImage.update');
    }
);
