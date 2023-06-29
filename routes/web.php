<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    Route::get('/', function () {
        return view('auth.login');
    });

    Auth::routes();

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'grade'], function () {

        Route::get('index', [GradeController::class, 'index'])->name('grade.index');
        Route::get('create', [GradeController::class, 'create'])->name('grade.create');
        Route::post('store', [GradeController::class, 'store'])->name('grade.store');
        Route::get('edit/{id}', [GradeController::class, 'edit'])->name('grade.edit');
        Route::post('update/{id}', [GradeController::class, 'update'])->name('grade.update');
        Route::get('destroy/{id}', [GradeController::class, 'destroy'])->name('grade.destroy');
    });

    Route::group(['prefix' => 'Classroom'], function () {

        Route::get('index', [ClassroomController::class, 'index'])->name('Classroom.index');
        Route::get('create', [ClassroomController::class, 'create'])->name('Classroom.create');
        Route::post('store', [ClassroomController::class, 'store'])->name('Classroom.store');
        Route::get('edit/{id}', [ClassroomController::class, 'edit'])->name('Classroom.edit');
        Route::post('update/{id}', [ClassroomController::class, 'update'])->name('Classroom.update');
        Route::get('destroy/{id}', [ClassroomController::class, 'destroy'])->name('Classroom.destroy');
        Route::post('destroySelect', [ClassroomController::class, 'destroySelect'])->name('Classroom.destroySelect');
        Route::post('Filter_Classes', [ClassroomController::class, 'Filter_Classes'])->name('Classroom.Filter_Classes');
    });

    Route::group(['prefix' => 'sections'], function () {

        Route::get('index', [SectionsController::class, 'index'])->name('sections.index');
        Route::get('create', [SectionsController::class, 'create'])->name('sections.create');
        Route::post('store', [SectionsController::class, 'store'])->name('sections.store');
        Route::get('edit/{id}', [SectionsController::class, 'edit'])->name('sections.edit');
        Route::post('update/{id}', [SectionsController::class, 'update'])->name('sections.update');
        Route::get('destroy/{id}', [SectionsController::class, 'destroy'])->name('sections.destroy');
        Route::get('classes/{id}', [SectionsController::class, 'getclasses'])->name('sections.getclasses');
    });

    Route::group(['prefix' => 'teachers'], function () {

        Route::get('index', [TeacherController::class, 'index'])->name('teachers.index');
        Route::get('create', [TeacherController::class, 'create'])->name('teachers.create');
        Route::post('store', [TeacherController::class, 'store'])->name('teachers.store');
        Route::get('edit/{id}', [TeacherController::class, 'edit'])->name('teachers.edit');
        Route::post('update/{id}', [TeacherController::class, 'update'])->name('teachers.update');
        Route::get('destroy/{id}', [TeacherController::class, 'destroy'])->name('teachers.destroy');
    });

    Route::view('add_parent', 'livewire.show_Form');


    Route::get('/{page}', [AdminController::class, 'index']);
});
