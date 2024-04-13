<?php

use App\Http\Controllers\teachers\AddImageTeachersController;
use App\Http\Controllers\teachers\ProfileController;
use App\Http\Controllers\teachers\QuestionsController;
use App\Http\Controllers\teachers\QuizzeController;
use App\Http\Controllers\teachers\StudentController;
use App\Models\Teacher;
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
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher']
    ],
    function () {

        //==============================dashboard============================
        Route::get('/teacher/dashboard', function () {

            $ids = Teacher::findorFail(auth()->user()->id)->Sections()->pluck('sections_id');
            $data['count_sections'] = $ids->count();
            $data['count_students'] = \App\Models\Student::whereIn('section_id', $ids)->count();


            return view('teachers.dashboard', $data);
        });


        Route::group(['prefix' => 'student'], function () {
            //==============================students============================
            Route::get('index', [StudentController::class, 'index'])->name('student.index');
            Route::get('sections', [StudentController::class, 'sections'])->name('sections');
            Route::post('attendance', [StudentController::class, 'attendance'])->name('attendance');
            // Route::post('edit', [StudentController::class, 'edit_attendance'])->name('edit_attendance');
            Route::get('attendance_report', [StudentController::class, 'attendance_report'])->name('attendance.report');
            Route::post('attendance_Search', [StudentController::class, 'attendance_Search'])->name('attendance.search');
        });


        Route::group(['prefix' => 'quizze'], function () {
            //==============================students============================
            Route::get('index', [QuizzeController::class, 'index'])->name('quizze.index');
            Route::get('create', [QuizzeController::class, 'create'])->name('quizze.create');
            Route::get('show/{id}', [QuizzeController::class, 'show'])->name('quizze.show');
            Route::post('store', [QuizzeController::class, 'store'])->name('quizze.store');
            Route::get('edit/{id}', [QuizzeController::class, 'edit'])->name('quizze.edit');
            Route::post('update/{id}', [QuizzeController::class, 'update'])->name('quizze.update');
            Route::post('destroy/{id}', [QuizzeController::class, 'destroy'])->name('quizze.destroy');
            Route::get('student_quizze/{id}', [QuizzeController::class, 'student_quizze'])->name('student.quizze');
            Route::post('repeat_quizze/{id}', [QuizzeController::class, 'repeat_quizze'])->name('repeat.quizze');
            // Route::get('Get_classrooms/{id}', [StudentController::class, 'getClassrooms'])->name('students.getClassrooms');
            // Route::get('Get_Sections/{id}', [StudentController::class, 'getSections'])->name('students.getSections');
        });

        Route::group(['prefix' => 'question'], function () {
            //==============================students============================
            Route::get('index', [QuestionsController::class, 'index'])->name('question.index');
            Route::get('create', [QuestionsController::class, 'create'])->name('question.create');
            Route::get('show/{id}', [QuestionsController::class, 'show'])->name('question.show');
            Route::post('store', [QuestionsController::class, 'store'])->name('question.store');
            Route::get('edit/{id}', [QuestionsController::class, 'edit'])->name('question.edit');
            Route::post('update/{id}', [QuestionsController::class, 'update'])->name('question.update');
            Route::post('destroy/{id}', [QuestionsController::class, 'destroy'])->name('question.destroy');
        });

        Route::group(['prefix' => 'profile'], function () {
            //==============================students============================
            Route::get('index', [ProfileController::class, 'index'])->name('profile.index');
            Route::post('update/{id}', [ProfileController::class, 'update'])->name('profile.update');
        });

        Route::post('/TeachersImage', [AddImageTeachersController::class, 'update'])->name('TeachersImage.update');
    }
);
