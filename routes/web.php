<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ExamsController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\FeesInvoicesController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\GraduatedController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\OnlineClassesController;
use App\Http\Controllers\PaymentStudentsController;
use App\Http\Controllers\ProcessingFeesController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\QuizzesController;
use App\Http\Controllers\ReceiptStudentController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\testController;
use App\Http\Controllers\users\AddImageController;
use App\Http\Controllers\users\ProfileUsersController;
use App\Http\Controllers\UsersController;
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

Route::get('/', [HomeController::class, 'index'])->name('selection');

Route::group(['namespace' => 'Auth'], function () {

    Route::get('/login/{type}', [LoginController::class, 'loginForm'])->middleware('guest')->name('login.show');

    Route::post('/login', [LoginController::class, 'login'])->name('login');

    Route::get('/logout/{type}', [LoginController::class, 'logout'])->name('logout');
});

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
], function () {

    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

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

    Route::group(['prefix' => 'students'], function () {

        Route::get('index', [StudentController::class, 'index'])->name('students.index');
        Route::get('create', [StudentController::class, 'create'])->name('students.create');
        Route::post('store', [StudentController::class, 'store'])->name('students.store');
        Route::get('edit/{id}', [StudentController::class, 'edit'])->name('students.edit');
        Route::post('update/{id}', [StudentController::class, 'update'])->name('students.update');
        Route::get('destroy/{id}', [StudentController::class, 'destroy'])->name('students.destroy');
        // Route::get('Get_classrooms/{id}', [StudentController::class, 'getClassrooms'])->name('students.getClassrooms');
        // Route::get('Get_Sections/{id}', [StudentController::class, 'getSections'])->name('students.getSections');
        Route::get('show/{id}', [StudentController::class, 'show'])->name('students.show');
        Route::post('Upload_attachment', [StudentController::class, 'Upload_attachment'])->name('students.Upload_attachment');
        Route::get('Download_attachment/{studentname}/{filename}', [StudentController::class, 'Download_attachment'])->name('students.Download_attachment');
        Route::get('Delete_attachment', [StudentController::class, 'Delete_attachment'])->name('students.Delete_attachment');
    });

    Route::group(['prefix' => 'Graduated'], function () {

        Route::get('index', [GraduatedController::class, 'index'])->name('Graduated.index');
        Route::get('create', [GraduatedController::class, 'create'])->name('Graduated.create');
        Route::post('store', [GraduatedController::class, 'store'])->name('Graduated.store');
        Route::get('edit/{id}', [GraduatedController::class, 'edit'])->name('Graduated.edit');
        Route::post('update/{id}', [GraduatedController::class, 'update'])->name('Graduated.update');
        Route::get('destroy/{id}', [GraduatedController::class, 'destroy'])->name('Graduated.destroy');
    });

    Route::group(['prefix' => 'promotion'], function () {

        Route::get('index', [PromotionController::class, 'index'])->name('promotion.index');
        Route::get('create', [PromotionController::class, 'create'])->name('promotion.create');
        Route::post('store', [PromotionController::class, 'store'])->name('promotion.store');
        Route::get('edit/{id}', [PromotionController::class, 'edit'])->name('promotion.edit');
        Route::post('update/{id}', [PromotionController::class, 'update'])->name('promotion.update');
        Route::post('destroy', [PromotionController::class, 'destroy'])->name('promotion.destroy');
        Route::post('Graduated/{id}', [PromotionController::class, 'Graduated'])->name('promotion.Graduated');
    });

    Route::group(['prefix' => 'teachers'], function () {

        Route::get('index', [TeacherController::class, 'index'])->name('teachers.index');
        Route::get('create', [TeacherController::class, 'create'])->name('teachers.create');
        Route::post('store', [TeacherController::class, 'store'])->name('teachers.store');
        Route::get('edit/{id}', [TeacherController::class, 'edit'])->name('teachers.edit');
        Route::post('update/{id}', [TeacherController::class, 'update'])->name('teachers.update');
        Route::get('destroy/{id}', [TeacherController::class, 'destroy'])->name('teachers.destroy');
    });

    Route::group(['prefix' => 'Fees'], function () {

        Route::get('index', [FeeController::class, 'index'])->name('Fees.index');
        Route::get('create', [FeeController::class, 'create'])->name('Fees.create');
        Route::post('store', [FeeController::class, 'store'])->name('Fees.store');
        Route::get('edit/{id}', [FeeController::class, 'edit'])->name('Fees.edit');
        Route::post('update/{id}', [FeeController::class, 'update'])->name('Fees.update');
        Route::get('destroy/{id}', [FeeController::class, 'destroy'])->name('Fees.destroy');
    });

    Route::group(['prefix' => 'FeesInvoices'], function () {

        Route::get('index', [FeesInvoicesController::class, 'index'])->name('Fees_Invoices.index');
        Route::get('create', [FeesInvoicesController::class, 'create'])->name('Fees_Invoices.create');
        Route::get('show/{id}', [FeesInvoicesController::class, 'show'])->name('Fees_Invoices.show');
        Route::post('store', [FeesInvoicesController::class, 'store'])->name('Fees_Invoices.store');
        Route::get('edit/{id}', [FeesInvoicesController::class, 'edit'])->name('Fees_Invoices.edit');
        Route::post('update/{id}', [FeesInvoicesController::class, 'update'])->name('Fees_Invoices.update');
        Route::post('destroy/{id}', [FeesInvoicesController::class, 'destroy'])->name('Fees_Invoices.destroy');
    });

    Route::group(['prefix' => 'ReceiptStudent'], function () {

        Route::get('index', [ReceiptStudentController::class, 'index'])->name('Receipt_Student.index');
        Route::get('create', [ReceiptStudentController::class, 'create'])->name('Receipt_Student.create');
        Route::get('show/{id}', [ReceiptStudentController::class, 'show'])->name('Receipt_Student.show');
        Route::post('store', [ReceiptStudentController::class, 'store'])->name('Receipt_Student.store');
        Route::get('edit/{id}', [ReceiptStudentController::class, 'edit'])->name('Receipt_Student.edit');
        Route::post('update/{id}', [ReceiptStudentController::class, 'update'])->name('Receipt_Student.update');
        Route::post('destroy/{id}', [ReceiptStudentController::class, 'destroy'])->name('Receipt_Student.destroy');
    });

    Route::group(['prefix' => 'ProcessingFee'], function () {

        Route::get('index', [ProcessingFeesController::class, 'index'])->name('ProcessingFee.index');
        Route::get('create', [ProcessingFeesController::class, 'create'])->name('ProcessingFee.create');
        Route::get('show/{id}', [ProcessingFeesController::class, 'show'])->name('ProcessingFee.show');
        Route::post('store', [ProcessingFeesController::class, 'store'])->name('ProcessingFee.store');
        Route::get('edit/{id}', [ProcessingFeesController::class, 'edit'])->name('ProcessingFee.edit');
        Route::post('update/{id}', [ProcessingFeesController::class, 'update'])->name('ProcessingFee.update');
        Route::post('destroy/{id}', [ProcessingFeesController::class, 'destroy'])->name('ProcessingFee.destroy');
    });

    Route::group(['prefix' => 'PaymentStudents'], function () {

        Route::get('index', [PaymentStudentsController::class, 'index'])->name('Payment_students.index');
        Route::get('create', [PaymentStudentsController::class, 'create'])->name('Payment_students.create');
        Route::get('show/{id}', [PaymentStudentsController::class, 'show'])->name('Payment_students.show');
        Route::post('store', [PaymentStudentsController::class, 'store'])->name('Payment_students.store');
        Route::get('edit/{id}', [PaymentStudentsController::class, 'edit'])->name('Payment_students.edit');
        Route::post('update/{id}', [PaymentStudentsController::class, 'update'])->name('Payment_students.update');
        Route::post('destroy/{id}', [PaymentStudentsController::class, 'destroy'])->name('Payment_students.destroy');
    });

    Route::group(['prefix' => 'Attendance'], function () {

        Route::get('index', [AttendanceController::class, 'index'])->name('Attendance.index');
        Route::get('show/{id}', [AttendanceController::class, 'show'])->name('Attendance.show');
        Route::post('store', [AttendanceController::class, 'store'])->name('Attendance.store');
    });

    Route::group(['prefix' => 'subjects'], function () {

        Route::get('index', [SubjectsController::class, 'index'])->name('subjects.index');
        Route::get('create', [SubjectsController::class, 'create'])->name('subjects.create');
        Route::get('show/{id}', [SubjectsController::class, 'show'])->name('subjects.show');
        Route::post('store', [SubjectsController::class, 'store'])->name('subjects.store');
        Route::get('edit/{id}', [SubjectsController::class, 'edit'])->name('subjects.edit');
        Route::post('update/{id}', [SubjectsController::class, 'update'])->name('subjects.update');
        Route::post('destroy/{id}', [SubjectsController::class, 'destroy'])->name('subjects.destroy');
        Route::get('classes/{id}', [SubjectsController::class, 'classes'])->name('subjects.classes');
    });

    Route::group(['prefix' => 'Quizzes'], function () {

        Route::get('index', [QuizzesController::class, 'index'])->name('Quizzes.index');
        Route::get('create', [QuizzesController::class, 'create'])->name('Quizzes.create');
        Route::get('show/{id}', [QuizzesController::class, 'show'])->name('Quizzes.show');
        Route::post('store', [QuizzesController::class, 'store'])->name('Quizzes.store');
        Route::get('edit/{id}', [QuizzesController::class, 'edit'])->name('Quizzes.edit');
        Route::post('update/{id}', [QuizzesController::class, 'update'])->name('Quizzes.update');
        Route::post('destroy/{id}', [QuizzesController::class, 'destroy'])->name('Quizzes.destroy');
        Route::get('classes/{id}', [QuizzesController::class, 'classes'])->name('Quizzes.classes');
        Route::get('MarkAsRead_all', [QuizzesController::class, 'MarkAsRead_all'])->name('Quizzes.MarkAsRead_all');
    });

    Route::group(['prefix' => 'Questions'], function () {

        Route::get('index', [QuestionsController::class, 'index'])->name('questions.index');
        Route::get('create', [QuestionsController::class, 'create'])->name('questions.create');
        Route::get('show/{id}', [QuestionsController::class, 'show'])->name('questions.show');
        Route::post('store', [QuestionsController::class, 'store'])->name('questions.store');
        Route::get('edit/{id}', [QuestionsController::class, 'edit'])->name('questions.edit');
        Route::post('update/{id}', [QuestionsController::class, 'update'])->name('questions.update');
        Route::post('destroy/{id}', [QuestionsController::class, 'destroy'])->name('questions.destroy');
    });

    Route::group(['prefix' => 'onlineClasses'], function () {

        Route::get('index', [OnlineClassesController::class, 'index'])->name('online_classes.index');
        Route::get('create', [OnlineClassesController::class, 'create'])->name('online_classes.create');
        Route::get('show/{id}', [OnlineClassesController::class, 'show'])->name('online_classes.show');
        Route::post('store', [OnlineClassesController::class, 'store'])->name('online_classes.store');
        Route::get('edit/{id}', [OnlineClassesController::class, 'edit'])->name('online_classes.edit');
        Route::post('update/{id}', [OnlineClassesController::class, 'update'])->name('online_classes.update');
        Route::post('destroy/{id}', [OnlineClassesController::class, 'destroy'])->name('online_classes.destroy');
    });

    Route::group(['prefix' => 'library'], function () {

        Route::get('index', [LibraryController::class, 'index'])->name('library.index');
        Route::get('create', [LibraryController::class, 'create'])->name('library.create');
        Route::get('show/{id}', [LibraryController::class, 'show'])->name('library.show');
        Route::post('store', [LibraryController::class, 'store'])->name('library.store');
        Route::get('edit/{id}', [LibraryController::class, 'edit'])->name('library.edit');
        Route::post('update/{id}', [LibraryController::class, 'update'])->name('library.update');
        Route::post('destroy/{id}', [LibraryController::class, 'destroy'])->name('library.destroy');
        Route::get('download/{name}', [LibraryController::class, 'download'])->name('library.downloadAttachment');
    });

    Route::group(['prefix' => 'setting'], function () {

        Route::get('index', [SettingController::class, 'index'])->name('settings.index');
        Route::post('update', [SettingController::class, 'update'])->name('settings.update');
    });

    Route::group(['prefix' => 'users'], function () {

        Route::get('index', [UsersController::class, 'index'])->name('users.index');
        Route::get('create', [UsersController::class, 'create'])->name('users.create');
        Route::post('store', [UsersController::class, 'store'])->name('users.store');
        Route::get('edit/{id}', [UsersController::class, 'edit'])->name('users.edit');
        Route::post('update/{id}', [UsersController::class, 'update'])->name('users.update');
        Route::get('destroy/{id}', [UsersController::class, 'destroy'])->name('users.destroy');
    });

    Route::group(['prefix' => 'profileUser'], function () {
        //==============================students============================
        Route::get('index', [ProfileUsersController::class, 'index'])->name('profileUser.index');
        Route::post('update/{id}', [ProfileUsersController::class, 'update'])->name('profileUser.update');
    });

    Route::post('/addimage', [AddImageController::class, 'update'])->name('addimage.update');

    Route::view('add_parent', 'livewire.show_Form')->name('add_parent');


    Route::get('/{page}', [AdminController::class, 'index']);
});
