<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\StudyagainController;
use App\Http\Controllers\RetestController;
use App\Http\Controllers\StudyresultController;
use App\Http\Controllers\ScholarshipController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'admin'], function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/login', [UserController::class, 'getLogin'])->name('admin.getLogin');
        Route::post('login', [UserController::class, 'postLogin'])->name('admin.postLogin');
        Route::get('/logout', [UserController::class, 'getLogout'])->name('admin.getLogout');

        //register
        Route::get('/register', [UserController::class, 'getRegister'])->name('admin.getRegister');
        Route::post('register', [UserController::class, 'postRegister'])->name('admin.postRegister');


        Route::get('/forgot-password', [UserController::class, 'getForgotPassword'])->name('admin.getForgotPassword');
        Route::post('forgot-password', [UserController::class, 'postForgotPassword'])->name('admin.postForgotPassword');

        //Duplicateemail
        Route::post('duplicateemail', [UserController::class, 'postDuplicateemail'])->name('admin.postDuplicateemail');

        //Lockscreen
        Route::get('/lockscreen', [UserController::class, 'getLockscreen'])->name('admin.getLockscreen');
        Route::post('lockscreen', [UserController::class, 'postLockscreen'])->name('admin.postLockscreen');

        //CheckCodeEmail
        Route::get('/check-code-email', [UserController::class, 'getCheckCodeEmail'])->name('admin.getCheckCodeEmail');
        Route::post('check-code-email', [UserController::class, 'postCheckCodeEmail'])->name('admin.postCheckCodeEmail');
    });
});
Route::middleware(['login'])->group(function () {
    Route::get('/', [PagesController::class, 'index'])->name('index');

    Route::middleware(['can:admin'])->group(function () {
        Route::get('list-users', [UserController::class, 'getListUser'])->name('getListUser');
    });

    Route::controller(UserController::class)->group(function () {
        Route::post('add', 'adduser')->name('adduser');
        Route::get('data', 'datajson')->name('data_json');
        Route::post('edit/{id}', 'postEdit')->name('postEdit');
        Route::get('detail/{id}', 'detail')->name('getDetail');
        Route::get('destroy/{id}', 'destroy')->name('getDestroy');
        Route::get('information-user', 'getInformationUser')->name('getInformationUser');
        Route::post('editinformation', 'postInformation')->name('postInformation');
    });

    Route::prefix('subject')->controller(SubjectController::class)->group(function () {
        Route::get('/', 'index')->name('subject.index');
        Route::get('data', 'datajson')->name('subject.data_json');
        Route::post('add', 'addsubject')->name('subject.addsubject');
        Route::post('duplicate', 'postDuplicate')->name('subject.postDuplicate');
        Route::post('edit/{id}', 'postEdit')->name('subject.editsubject');
        Route::get('detail/{id}', 'detail')->name('subject.getDetail');
        Route::get('destroy/{id}', 'destroy')->name('subject.getDestroy');
    });

    Route::prefix('class')->controller(ClassController::class)->group(function () {
        Route::get('/', 'index')->name('class.index');
        Route::get('data', 'datajson')->name('class.data_json');
        Route::post('add', 'addclass')->name('class.addclass');
        Route::post('duplicate', 'postDuplicate')->name('class.postDuplicate');
        Route::post('edit/{id}', 'postEdit')->name('class.editclass');
        Route::get('detail/{id}', 'detail')->name('class.getDetail');
        Route::get('destroy/{id}', 'destroy')->name('class.getDestroy');
    });

    Route::middleware(['can:admin'])->prefix('point')->controller(PointController::class)->group(function () {
        Route::get('/', 'index')->name('point.index');
        Route::get('data', 'datajson')->name('point.data_json');
        Route::get('/{id}', 'index')->name('point.monhoc');
        Route::post('save', 'savediem')->name('point.savediem');
    });

    Route::middleware(['can:user'])->prefix('point-list')->controller(PointController::class)->group(function () {
        Route::get('/', 'userindex')->name('point-list.index');
    });

    Route::prefix('student')->controller(StudentController::class)->group(function () {
        Route::get('/', 'index')->name('student.index');
        Route::get('data', 'datajson')->name('student.data_json');
        Route::post('add', 'addstudent')->name('student.addstudent');
        Route::get('export', 'getexport')->name('student.getexport');
        Route::get('destroy/{id}', 'destroy')->name('student.getDestroy');
        Route::post('edit/{id}', 'postEdit')->name('student.postEdit');
        Route::get('detail/{id}', 'detail')->name('student.getDetail');
    });

    Route::prefix('lecturer')->controller(LecturerController::class)->group(function () {
        Route::get('/', 'index')->name('lecturer.index');
        Route::get('data', 'datajson')->name('lecturer.data_json');
        Route::post('add', 'addlecturer')->name('lecturer.addlecturer');
        Route::get('destroy/{id}', 'destroy')->name('lecturer.getDestroy');
        Route::post('edit/{id}', 'postEdit')->name('lecturer.postEdit');
        Route::get('detail/{id}', 'detail')->name('lecturer.getDetail');
    });

    Route::prefix('studyagain')->controller(StudyagainController::class)->group(function () {
        Route::get('/', 'index')->name('studyagain.index');
        Route::get('data', 'datajson')->name('studyagain.data_json');
    });

    Route::prefix('retest')->controller(RetestController::class)->group(function () {
        Route::get('/', 'index')->name('retest.index');
        Route::get('data', 'datajson')->name('retest.data_json');
    });

    Route::prefix('studyresult')->controller(StudyresultController::class)->group(function () {
        Route::get('/{lopid}/{namhoc}/{hocky}', 'index');
        Route::post('save', 'savediemrl')->name('studyresult.diemrl');
    });

    Route::prefix('scholarship')->controller(ScholarshipController::class)->group(function () {
        Route::get('/{namhoc}/{hocky}/{hocbong}', 'index')->name('scholarship.index');
        Route::post('save', 'savehocbong')->name('scholarship.hocbong');
    });
});
