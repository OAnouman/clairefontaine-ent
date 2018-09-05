<?php

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


// Auth route

Auth::routes();

Route::get('/admin/user', 'Auth\RegisterController@index')->name('user.index');

Route::get('/admin/user/{user}/edit', 'Auth\RegisterController@edit')->name('user.edit');

Route::patch('/admin/user/{user}', 'Auth\RegisterController@update')->name('user.update');

Route::delete('/admin/user/{user}', 'Auth\RegisterController@destroy')->name('user.destroy');



// Home

Route::get('/', 'HomeController@index')->name('home');



/*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    |
    | All URL used for administration dashboard
    |
*/



// School Year route

Route::resource('/admin/settings/school_year', 'Admin\SchoolYearController');



// School Year Period routes

Route::resource('/admin/settings/school_year_period', 'Admin\SchoolYearPeriodController');


// Level routes

Route::resource('/admin/settings/level', 'Admin\LevelController');


// Classroom routes

Route::resource('/admin/classroom', 'Admin\ClassroomController');

// Classroom Student routes

Route::get('/admin/classroom_student', 'Admin\ClassroomStudentController@index')->name('classroom_student.index');

Route::post('/admin/classroom_student', 'Admin\ClassroomStudentController@store')->name('classroom_student.store');

Route::delete('/admin/classroom_student/{classroom_id}/{student_id}', 'Admin\ClassroomStudentController@destroy')->name('classroom_student.destroy');

Route::get('/admin/classroom_student/{classroom}', 'Admin\ClassroomStudentController@print')->name('classroom_student.print');


//Teacher routes

Route::resource('/admin/settings/teacher', 'Admin\TeacherController');

//Subject routes

Route::resource('/admin/settings/subject', 'Admin\SubjectController');

// Level subject routes

Route::get('/admin/settings/level_subject', 'Admin\LevelSubjectController@index')->name('level_subject.index');

Route::get('/admin/settings/level_subject/create', 'Admin\LevelSubjectController@create')->name('level_subject.create');

Route::delete('/admin/settings/level_subject/{level}/{subject}', 'Admin\LevelSubjectController@destroy')->name('level_subject.destroy');

Route::post('/admin/settings/level_subject', 'Admin\LevelSubjectController@store')->name('level_subject.store');

Route::patch('/admin/settings/level_subject', 'Admin\LevelSubjectController@update')->name('level_subject.update');

Route::get('/admin/settings/level_subject/{level}/{subject}/edit', 'Admin\LevelSubjectController@edit')->name('level_subject.edit');

// Classroom teacher routes

Route::get('/admin/settings/classroom_teacher', 'Admin\ClassroomTeacherController@index')->name('classroom_teacher.index');

Route::get('/admin/settings/classroom_teacher/create', 'Admin\ClassroomTeacherController@create')->name('classroom_teacher.create');

Route::delete('/admin/settings/classroom_teacher/{classroom}/{teacher}/{subject}', 'Admin\ClassroomTeacherController@destroy')->name('classroom_teacher.destroy');

Route::post('/admin/settings/classroom_teacher', 'Admin\ClassroomTeacherController@store')->name('classroom_teacher.store');

Route::patch('/admin/settings/classroom_teacher', 'Admin\ClassroomTeacherController@update')->name('classroom_teacher.update');

Route::get('/admin/settings/classroom_teacher/{classroom}/{teacher}/edit', 'Admin\ClassroomTeacherController@edit')->name('classroom_teacher.edit');

// Students routes

Route::resource('/admin/student', 'Admin\StudentController');

Route::get('/admin/import', 'Admin\StudentController@import')->name('student.import');

Route::post('/admin/import_csv', 'Admin\StudentController@importCsv')->name('student.import_csv');

Route::get('/admin/student/{student}/print', 'Admin\StudentController@print')->name('student.print');

// Scholarship settings route

Route::resource('/admin/settings/scholarship', 'Admin\ScholarshipSettingsController');


// Emergency contact route

// TODO : fix route name, remove ajax prefix

Route::post('/ajax/add_emergency_contact', 'Admin\EmergencyPeopleController@store');

Route::delete('/ajax/emergency_contact/{emergency_contact}', 'Admin\EmergencyPeopleController@destroy');

// Ajax route request






/*
    |--------------------------------------------------------------------------
    | Teacher Routes
    |--------------------------------------------------------------------------
    |
    | All URLs used for teacher dashboard
    |
*/


Route::get('/admin_teacher/classroom', 'Teacher\ClassesTeacherController@index')->name('teacher_classroom.index');

Route::get('/admin_teacher/classroom/{classroom}', 'Teacher\ClassesTeacherController@show')->name('teacher_classroom.show');

Route::resource('/admin_teacher/evaluation', 'Teacher\EvaluationController');

Route::resource('/admin_teacher/grade', 'Teacher\GradeController');

Route::resource('/admin_teacher/message_center', 'Teacher\MessageCenterController');





/*
    |--------------------------------------------------------------------------
    | Parent / Student  Routes
    |--------------------------------------------------------------------------
    |
    | All URLs used for parent/student  dashboard
    |
*/


Route::get('/admin_parent', 'Parent\DashboardController@index')->name('parent.dashboard');

Route::get('/admin_parent/evaluation/{school_year_period_id}/{classroom_id}', 'Parent\EvaluationController@show')
    ->name('parent.evaluation');

Route::get('/admin_parent/profile/{student}', 'Parent\DashboardController@show')->name('parent.profile');

Route::resource('/admin_parent/message_center_parent', 'Parent\MessageCenterController');


Route::get('/classroom_subjects/{classroom_id}', 'Parent\DashboardController@subjects');

Route::get('/student_grade/{subject_id}/{begin_date}/{end_date}/{classroom_id}', 'Parent\DashboardController@grades');

Route::get('/subjects/{classroom}', 'Parent\DashboardController@getSubjects');

Route::get('/periods/{classroom}', 'Parent\DashboardController@getPeriods');

Route::get('/averages/{student}/{school_year_period}/{classroom?}', 'Parent\DashboardController@average');

Route::get('/evaluations/{student}/{limit?}', 'Parent\DashboardController@evaluations');

Route::get('/profile_overview/{student}', 'Parent\DashboardController@profileOverview');

Route::post('/message', 'MessageController@store');

Route::get('/message/update/{message_thread_id}/{user_id}', 'MessageController@update');


