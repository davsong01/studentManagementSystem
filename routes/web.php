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
Route::get('/test', 'HomeController@test')->name('test');

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'HomeController@profile')->name('profile');
Route::get('/profile/edit', 'HomeController@profileEdit')->name('profile.edit');
Route::put('/profile/update', 'HomeController@profileUpdate')->name('profile.update');
Route::get('/profile/changepassword', 'HomeController@changePasswordForm')->name('profile.change.password');
Route::post('/profile/changepassword', 'HomeController@changePassword')->name('profile.changepassword');

Route::group(['middleware' => ['auth','role:Admin']], function () 
{
    Route::get('/roles-permissions', 'RolePermissionController@roles')->name('roles-permissions');
    Route::get('/role-create', 'RolePermissionController@createRole')->name('role.create');
    Route::post('/role-store', 'RolePermissionController@storeRole')->name('role.store');
    Route::get('/role-edit/{id}', 'RolePermissionController@editRole')->name('role.edit');
    Route::put('/role-update/{id}', 'RolePermissionController@updateRole')->name('role.update');

    Route::get('/permission-create', 'RolePermissionController@createPermission')->name('permission.create');
    Route::post('/permission-store', 'RolePermissionController@storePermission')->name('permission.store');
    Route::get('/permission-edit/{id}', 'RolePermissionController@editPermission')->name('permission.edit');
    Route::put('/permission-update/{id}', 'RolePermissionController@updatePermission')->name('permission.update');

    Route::get('assign-subject-to-class/{id}', 'GradeController@assignSubject')->name('class.assign.subject');
    Route::post('assign-subject-to-class/{id}', 'GradeController@storeAssignedSubject')->name('store.class.assign.subject');
    Route::get('admin-results-single/{result}', 'ResultController@singleResult')->name('admin-result.show');
    Route::resource('assignrole', 'RoleAssign');
    Route::resource('classes', 'GradeController');
    Route::resource('course', 'CourseController');
    Route::resource('payments', 'PaymentsController');
    Route::resource('setting', 'SettingController');
    Route::resource('faculty', 'FacultyController');
    Route::resource('transaction', 'TransactionController');
    Route::resource('result', 'ResultController');
    Route::get('result-faculty/{faculty?}/{dept?}/{l?}/{s?}/{p?}/{as?}', 'ResultController@getDepartmentResults')->name('result.faculty');
    Route::resource('department', 'DepartmentController');
    Route::resource('parents', 'ParentsController');
    Route::resource('student', 'StudentController');
    Route::resource('courseForm', 'CourseFormController');
    Route::post('show-available-courses', 'CourseFormController@showAvailableCourses')->name('available.courses');
    Route::get('attendance', 'AttendanceController@index')->name('attendance.index');
    Route::post('/publish-result', "ResultController@publishResult")->name('publis.result');
});

Route::group(['middleware' => ['auth','role:Teacher']], function () 
{
    Route::post('attendance', 'AttendanceController@store')->name('teacher.attendance.store');
    Route::get('attendance-create/{classid}', 'AttendanceController@createByTeacher')->name('teacher.attendance.create');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('payment/show/{id}', 'HomeController@singlePayment')->name('payments.show');
});

Route::group(['middleware' => ['auth','role:Student']], function () {
    Route::get('biodata/{student}', 'HomeController@profileEdit')->name('biodata.edit');
    Route::patch('biodata/{student}', 'HomeController@profileUpdate')->name('biodata.save');

    Route::get('courses-form/{student}', 'HomeController@viewCourseForm')->name('coursesform.edit');
    Route::post('courses-form/{student}', 'HomeController@updateCourseForm')->name('coursesform.save');
    Route::get('view-courses-form/{student}', 'HomeController@printCourseForm')->name('coursesform.view');

    Route::get('results-list', 'ResultController@listResults')->name('results.list');
    Route::get('results-single/{result}', 'ResultController@singleResult')->name('result.show');

    Route::get('student/courses', 'HomeController@viewCourse')->name('student.course');
    Route::get('student/courses', 'HomeController@registerCourse')->name('student.register.course');
    Route::post('student/courses', 'HomeController@registerCourse')->name('student.save.course');

    Route::get('gp/cal1', 'GpController@index')->name('gp.cal1');
    Route::post('gp/cal1', 'GpController@process')->name('gp.cal2');
    Route::get('make-payments', 'PaymentsController@showPayments')->name('make-payments');
    Route::get('payments-history', 'PaymentsController@paymentsHistory')->name('payments.history');
    Route::get('initialize-payments/{id}', 'PaymentsController@initializePayment')->name('payments.initilize');
    Route::get('payment/callback', 'PaymentsController@processPayment');
    
    Route::get('clear-session', function(){
        \Session::remove('courses');
        \Session::remove('gp');

        return response()->json(['status'=>200]);
    });
});
