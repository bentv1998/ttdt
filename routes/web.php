<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
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

Auth::routes(['verify' => true]);
Route::get('/change-language/{lang}', function ($lang) {
    session()->put('website_language', $lang);
    return \response()->redirectTo(url()->previous());
})->name('change.language');
Route::group(['middleware' => ['locale']], function () {

    Route::get('/home', 'User\HomeController@index')->name('home.user');
    Route::group(['middleware' => ['auth', 'verified']], function () {

        Route::group(['prefix' => '/admin'], function () {
            Route::get('/', 'Admin\DashboardController@index')->name('home');

            Route::resource('classes', 'Admin\ClassController')->parameters(['classes' => 'model']);
            Route::post('classes/datatable', 'Admin\ClassController@datatable')->name('classes.datatable');
            Route::get('classes-search-teacher', 'Admin\ClassController@searchTeacher')->name('classes.search.teacher');
            Route::get('classes-search-schedule', 'Admin\ClassController@searchSchedule')->name('classes.search.schedule');

            Route::resource('schedules', 'Admin\ScheduleController')->parameters(['schedules' => 'model']);
            Route::post('schedules/datatable', 'Admin\ScheduleController@datatable')->name('schedules.datatable');

            Route::resource('students', 'Admin\StudentController')->parameters(['students' => 'model']);
            Route::post('students/datatable', 'Admin\StudentController@datatable')->name('students.datatable');
            Route::get('students-search-parent', 'Admin\StudentController@searchParent')->name('students.search.parent');

            Route::resource('parents', 'Admin\ParentController')->parameters(['parents' => 'model']);
            Route::post('parents/datatable', 'Admin\ParentController@datatable')->name('parents.datatable');

            Route::resource('staffs', 'Admin\StaffController')->parameters(['staffs' => 'model']);
            Route::post('staffs/datatable', 'Admin\StaffController@datatable')->name('staffs.datatable');

            Route::resource('teachers', 'Admin\TeacherController')->parameters(['teachers' => 'model']);
            Route::post('teachers/datatable', 'Admin\TeacherController@datatable')->name('teachers.datatable');

            Route::resource('mails', 'Admin\MailController')->parameters(['mails' => 'model']);
            Route::post('mails/datatable', 'Admin\MailController@datatable')->name('mails.datatable');

            Route::resource('categories', 'Admin\CategoryController')->parameters(['categories' => 'model']);

            Route::resource('products', 'Admin\ProductController')->parameters(['products' => 'model']);
        });
    });
});
