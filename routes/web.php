<?php

use Illuminate\Support\Facades\Route;


//Route::get('/sms', function () {
//    $url = "http://66.45.237.70/api.php";
//$number="01792702312";
//$text="Hello Bangladesh";
//$data= array(
//'username'=>"01792702312",
//'password'=>"8PDS4FC7",
//'number'=>"$number",
//'message'=>"$text"
//);
//
//$ch = curl_init(); // Initialize cURL
//curl_setopt($ch, CURLOPT_URL,$url);
//curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//$smsresult = curl_exec($ch);
//$p = explode("|",$smsresult);
//$sendstatus = $p[0];
//});

Route::get('/', 'Frontend\HomeController@index');
Route::get('/noticeboard', 'Frontend\NoticeController@index')->name('noticeboard');
Route::get('/single/noticeboard/{slug}/{id}', 'Frontend\NoticeController@singe_notice')->name('single.noticeboard');
Route::get('/result', 'Frontend\ResultController@index')->name('result');
Route::get('/get/student/result', 'Frontend\ResultController@get_result')->name('get.student.result');

//---------Online Admission------------
Route::get('/admition', 'Frontend\OnlineAdmission@index')->name('online.admission');
Route::post('/send/admition', 'Frontend\OnlineAdmission@store')->name('store.admission');


Auth::routes(['register' => false]);

Route::group([ 'namespace' => 'Backend', 'middleware' => ['auth']], function (){

	//--------Dashboard------
	Route::get('/home', 'DashboardController@index')->name('home');



    //---------Manage Website------------
    Route::group([ 'namespace' => 'Website', 'prefix' => 'website'], function (){
        //---------Headline Routes---------
        Route::get('/view/headline', 'HeadlineController@show')->name('view.headline');
        Route::get('/edit/headline/{id}', 'HeadlineController@edit')->name('edit.headline');
        Route::post('/update/headline/{id}', 'HeadlineController@update')->name('update.headline');

        //---------Main Description---------
        Route::get('/view/description', 'DescriptionController@show')->name('view.description');
        Route::get('/edit/description/{id}', 'DescriptionController@edit')->name('edit.description');
        Route::post('/update/description/{id}', 'DescriptionController@update')->name('update.description');

        //---------Slider---------
        Route::get('/view/slider', 'SliderController@show')->name('view.slider');
        Route::get('/edit/slider/{id}', 'SliderController@edit')->name('edit.slider');
        Route::post('/update/slider/{id}', 'SliderController@update')->name('update.slider');

        //---------Noticeboard---------
        Route::get('/view/notice', 'NoticeController@show')->name('view.notice');
        Route::get('/add/notice', 'NoticeController@add')->name('add.notice');
        Route::post('/store/notice', 'NoticeController@store')->name('store.notice');
        Route::get('/edit/notice/{id}', 'NoticeController@edit')->name('edit.notice');
        Route::post('/update/notice/{id}', 'NoticeController@update')->name('update.notice');
        Route::post('/destroy/notice/{id}', 'NoticeController@destroy')->name('destroy.notice');

        //---------Result Published Date---------
        Route::get('/view/date', 'PublishedDateController@show')->name('view.date');
        Route::get('/edit/date/{id}', 'PublishedDateController@edit')->name('edit.date');
        Route::post('/update/date/{id}', 'PublishedDateController@update')->name('update.date');

        //---------Admission---------
        Route::get('/view/admission', 'AdmissionController@show')->name('view.admission');
        Route::get('/details/admission/{id}', 'AdmissionController@details')->name('details.admission');
        Route::post('/destroy/admission/{id}', 'AdmissionController@destroy')->name('destroy.admission');
    });

    //---------End Manage Website----------




    //---------Manage User------------
    Route::prefix('users')->group(function (){
        Route::get('/view', 'UserController@show')->name('view.user');
        Route::get('/add', 'UserController@add')->name('add.user');
        Route::post('/store', 'UserController@store')->name('store.user');
        Route::get('/edit/{id}', 'UserController@edit')->name('edit.user');
        Route::post('/update/{id}', 'UserController@update')->name('update.user');
        Route::post('/destroy/{id}', 'UserController@destroy')->name('destroy.user');
    });

    //Profile Routes Are Here----
    Route::prefix('profile')->group(function (){
        Route::get('/view', 'ProfileController@show')->name('view.profile');
        Route::get('/edit/{id}', 'ProfileController@edit')->name('edit.profile');
        Route::post('/update/{id}', 'ProfileController@update')->name('update.profile');
        Route::get('/change/password', 'ProfileController@show_password')->name('change.password');
        Route::post('/update_password', 'ProfileController@update_password')->name('update.password');
    });

    Route::group([ 'namespace' => 'Setup', 'prefix' => 'setup'], function (){
        //=======================Student class==========================
        Route::get('/view/class', 'ClassController@show')->name('view.class');
        Route::get('/add/class', 'ClassController@add')->name('add.class');
        Route::post('/store/class', 'ClassController@store')->name('store.class');
        Route::get('/edit/class/{id}', 'ClassController@edit')->name('edit.class');
        Route::post('/update/class/{id}', 'ClassController@update')->name('update.class');
        Route::post('/destroy/class/{id}', 'ClassController@destroy')->name('destroy.class');

        //=======================Student Year==========================
        Route::get('/view/year', 'YearController@show')->name('view.year');
        Route::get('/add/year', 'YearController@add')->name('add.year');
        Route::post('/store/year', 'YearController@store')->name('store.year');
        Route::get('/edit/year/{id}', 'YearController@edit')->name('edit.year');
        Route::post('/update/year/{id}', 'YearController@update')->name('update.year');
        Route::post('/destroy/year/{id}', 'YearController@destroy')->name('destroy.year');

        //=======================Fee Category==========================
        Route::get('/view/free/category', 'FeeCategoryController@show')->name('view.fee.category');
        Route::get('/edit/free/category/{id}', 'FeeCategoryController@edit')->name('edit.fee.category');
        Route::post('/update/free/category/{id}', 'FeeCategoryController@update')->name('update.fee.category');

        //=======================Free Category Amount==========================
        Route::get('/view/fee/amount', 'FeeAmountController@show')->name('view.fee.amount');
        Route::get('/add/fee/amount', 'FeeAmountController@add')->name('add.fee.amount');
        Route::post('/store/fee/amount', 'FeeAmountController@store')->name('store.fee.amount');
        Route::get('/edit/fee/amount/{fee_category_id}', 'FeeAmountController@edit')->name('edit.fee.amount');
        Route::post('/update/fee/amount/{fee_category_id}', 'FeeAmountController@update')->name('update.fee.amount');
        Route::get('/details/fee/amount/{fee_category_id}', 'FeeAmountController@details')->name('details.fee.amount');

        //=======================Exam Type==========================
        Route::get('/view/exam', 'ExamTypeController@show')->name('view.exam');
        Route::get('/add/exam', 'ExamTypeController@add')->name('add.exam');
        Route::post('/store/exam', 'ExamTypeController@store')->name('store.exam');
        Route::get('/edit/exam/{id}', 'ExamTypeController@edit')->name('edit.exam');
        Route::post('/update/exam/{id}', 'ExamTypeController@update')->name('update.exam');
        Route::post('/destroy/exam/{id}', 'ExamTypeController@destroy')->name('destroy.exam');

        //=======================Subject==========================
        Route::get('/view/subject', 'SubjectController@show')->name('view.subject');
        Route::get('/add/subject', 'SubjectController@add')->name('add.subject');
        Route::post('/store/subject', 'SubjectController@store')->name('store.subject');
        Route::get('/edit/subject/{id}', 'SubjectController@edit')->name('edit.subject');
        Route::post('/update/subject/{id}', 'SubjectController@update')->name('update.subject');
        Route::post('/destroy/subject/{id}', 'SubjectController@destroy')->name('destroy.subject');

        //=======================Assign Subject==========================
        Route::get('/view/assign/subject', 'AssignSubjectController@show')->name('view.assign.subject');
        Route::get('/add/assign/subject', 'AssignSubjectController@add')->name('add.assign.subject');
        Route::post('/store/assign/subject', 'AssignSubjectController@store')->name('store.assign.subject');
        Route::get('/edit/assign/subject/{class_id}', 'AssignSubjectController@edit')->name('edit.assign.subject');
        Route::post('/update/assign/subject/{class_id}', 'AssignSubjectController@update')->name('update.assign.subject');
        Route::post('/destroy/assign/subject/{class_id}', 'AssignSubjectController@destroy')->name('destroy.assign.subject');
        Route::get('/details/assign/subject/{class_id}', 'AssignSubjectController@details')->name('details.assign.subject');

        //=======================Designation==========================
        Route::get('/view/designation', 'DesignationController@show')->name('view.designation');
        Route::get('/add/designation', 'DesignationController@add')->name('add.designation');
        Route::post('/store/designation', 'DesignationController@store')->name('store.designation');
        Route::get('/edit/designation/{id}', 'DesignationController@edit')->name('edit.designation');
        Route::post('/update/designation/{id}', 'DesignationController@update')->name('update.designation');
        Route::post('/destroy/designation/{id}', 'DesignationController@destroy')->name('destroy.designation');
    });

    //--------------Student Managment----------
    Route::group([ 'namespace' => 'Student', 'prefix' => 'student'], function (){
        //---------Student Registration--------
        Route::get('/view', 'StudentRegController@show')->name('view.student');
        Route::get('/add', 'StudentRegController@add')->name('add.student');
        Route::post('/store', 'StudentRegController@store')->name('store.student');
        Route::get('/edit/{id}', 'StudentRegController@edit')->name('edit.student');
        Route::post('/update/{id}', 'StudentRegController@update')->name('update.student');
        Route::get('/promotion/{id}', 'StudentRegController@promotion')->name('promotion.student');
        Route::post('/promotion/store/{id}', 'StudentRegController@promotion_store')->name('promotion.student.store');
        Route::get('/details/pdf/{id}', 'StudentRegController@details')->name('details.student');
        //-------search--------
        Route::get('/year-class-wise', 'StudentRegController@yearClassWise')->name('year.class.wise.student');

        //=======================Student Roll Generate==========================
        Route::get('/view/roll', 'StudentRollController@show')->name('view.student.roll');
        //-----Ajex------
        Route::get('/roll/get-student', 'StudentRollController@get_student')->name('get.student.roll');
        //----End Ajex----
        Route::post('/roll/store', 'StudentRollController@store')->name('store.student.roll');

        //=======================Student Attendance==========================
        Route::get('/view/attendance', 'StudentAttendanceController@show')->name('view.student.attendance');
        Route::get('/get/attend', 'StudentAttendanceController@get_attend_student')->name('get.attend.student');
        Route::get('/add/attendance', 'StudentAttendanceController@add')->name('add.student.attendance');
        Route::post('/store/attendance', 'StudentAttendanceController@store')->name('store.student.attendance');
        Route::get('/edit/attendance/{date}/{class_id}/{year_id}', 'StudentAttendanceController@edit')->name('edit.student.attendance');
        Route::post('/update/attendance/{date}', 'StudentAttendanceController@update')->name('update.student.attendance');
        Route::get('/details/attendance/{date}/{class_id}/{year_id}', 'StudentAttendanceController@details')->name('details.student.attendance');

        //=======================Registration Fee==========================
        Route::get('/reg/fee/view', 'RegistrationFeeController@show')->name('view.student.reg.fee');
        Route::get('/reg/get-student', 'RegistrationFeeController@get_student')->name('get.student.reg.fee');
        Route::get('/reg/fee/payslip', 'RegistrationFeeController@payslip')->name('student.reg.fee.payslip');

        //=======================Monthly Fee==========================
        Route::get('/monthly/fee/view', 'MonthlyFeeController@show')->name('view.student.monthly.fee');
        Route::get('/monthly/fee/get-student', 'MonthlyFeeController@get_student')->name('get.student.monthly.fee');
        Route::get('/monthly/fee/payslip', 'MonthlyFeeController@payslip')->name('student.monthly.fee.payslip');

        //=======================Exam Fee==========================
        Route::get('/exam/fee/view', 'ExamFeeController@show')->name('view.student.exam.fee');
        Route::get('/exam/fee/get-student', 'ExamFeeController@get_student')->name('get.student.exam.fee');
        Route::get('/exam/fee/payslip', 'ExamFeeController@payslip')->name('student.exam.fee.payslip');
    });

    //--------------Student Managment----------
    Route::group([ 'namespace' => 'Employee', 'prefix' => 'employee'], function (){
        //=======================Employee Registration==========================
        Route::get('/view', 'EmployeeRegController@show')->name('view.employee');
        Route::get('/add', 'EmployeeRegController@add')->name('add.employee');
        Route::post('/store', 'EmployeeRegController@store')->name('store.employee');
        Route::get('/edit/{id}', 'EmployeeRegController@edit')->name('edit.employee');
        Route::post('/update/{id}', 'EmployeeRegController@update')->name('update.employee');
        Route::get('/details/{id}', 'EmployeeRegController@details')->name('details.employee');

        //=======================Employee Salary==========================
        Route::get('/view/salary', 'EmployeeSalaryController@show')->name('view.employee.salary');
        Route::get('/increment/salary/{id}', 'EmployeeSalaryController@increment')->name('increment.employee.salary');
        Route::post('/store/increment/salary/{id}', 'EmployeeSalaryController@store')->name('store.increment.employee.salary');
        Route::get('/increment/salary/details/{id}', 'EmployeeSalaryController@details')->name('details.increment.employee.salary');

        //=======================Employee Leave==========================
        Route::get('/view/leave', 'EmployeeLeaveController@show')->name('view.employee.leave');
        Route::get('/add/leave', 'EmployeeLeaveController@add')->name('add.employee.leave');
        Route::post('/store/leave', 'EmployeeLeaveController@store')->name('store.employee.leave');
        Route::get('/edit/leave/{id}', 'EmployeeLeaveController@edit')->name('edit.employee.leave');
        Route::post('/update/leave/{id}', 'EmployeeLeaveController@update')->name('update.employee.leave');

        //=======================Employee Attendance==========================
        Route::get('/view/attendance', 'EmployeeAttendanceController@show')->name('view.employee.attendance');
        Route::get('/add/attendance', 'EmployeeAttendanceController@add')->name('add.employee.attendance');
        Route::post('/store/attendance', 'EmployeeAttendanceController@store')->name('store.employee.attendance');
        Route::get('/edit/attendance/{date}', 'EmployeeAttendanceController@edit')->name('edit.employee.attendance');
        Route::post('/update/attendance/{date}', 'EmployeeAttendanceController@update')->name('update.employee.attendance');
        Route::get('/details/attendance/{date}', 'EmployeeAttendanceController@details')->name('details.employee.attendance');

        //=======================Employee Monthly Salary==========================
        Route::get('/view/monthly/salary', 'EmployeeMonthlySalaryController@show')->name('view.employee.monthly.salary');
        Route::get('/get/monthly/salary', 'EmployeeMonthlySalaryController@get_salary')->name('get.employee.monthly.salary');
        Route::get('/payslip/monthly/salary', 'EmployeeMonthlySalaryController@pay_slip')->name('payslip.employee.monthly.salary');
    });

    //=======================Marks Managment Routes==========================
    Route::group([ 'namespace' => 'Marks', 'prefix' => 'marks'], function (){
        Route::get('/add', 'MarksController@add')->name('add.marks');
        Route::get('/get/subject', 'MarksController@get_subject')->name('get_subject');
        Route::get('/get/student', 'MarksController@get_student')->name('get.student');
        Route::post('/store', 'MarksController@store')->name('store.marks');
        Route::get('/edit', 'MarksController@edit')->name('edit.marks');
        Route::get('/get/student/marks', 'MarksController@get_student_marks')->name('get.student.marks');
        Route::post('/update', 'MarksController@update')->name('update.marks');

        //Grade Points-----
        Route::get('/view/grade', 'GradeController@show')->name('view.grade');
        Route::get('/add/grade', 'GradeController@add')->name('add.grade');
        Route::post('/store/grade', 'GradeController@store')->name('store.grade');
        Route::get('/edit/grade/{id}', 'GradeController@edit')->name('edit.grade');
        Route::post('/update/grade/{id}', 'GradeController@update')->name('update.grade');
    });

    //=======================Account Managment==========================
    Route::group([ 'namespace' => 'Account', 'prefix' => 'account'], function (){
        //-------Students Fee--------
        Route::get('/view/student/fee', 'StudentFeeController@show')->name('view.student.fee');
        Route::get('/add/student/fee', 'StudentFeeController@add')->name('add.student.fee');
        Route::get('/get/student/fee', 'StudentFeeController@get_student_fee')->name('get.student.fee');
        Route::post('/store/student/fee', 'StudentFeeController@store')->name('store.student.fee');
        Route::get('/details/student/fee/{date}', 'StudentFeeController@details')->name('details.student.fee');
        //-------Employee Salary--------
        Route::get('/view/employee/salary', 'SalaryController@show')->name('account.view.employee.salary');
        Route::get('/add/employee/salary', 'SalaryController@add')->name('account.add.employee.salary');
        Route::get('/get/employee/salary', 'SalaryController@get_student_fee')->name('account.get.employee.salary');
        Route::post('/store/employee/salary', 'SalaryController@store')->name('account.store.employee.salary');
        Route::get('/details/employee/salary/{date}', 'SalaryController@details')->name('details.employee.salary');

        //-------Others Cost--------
        Route::get('/view/other/cost', 'OtherCostController@show')->name('view.other.cost');
        Route::get('/add/other/cost', 'OtherCostController@add')->name('add.other.cost');
        Route::post('/store/other/cost', 'OtherCostController@store')->name('store.other.cost');
        Route::get('/edit/other/cost/{id}', 'OtherCostController@edit')->name('edit.other.cost');
        Route::post('/update/other/cost{id}', 'OtherCostController@update')->name('update.other.cost');
        Route::post('/destroy/other/cost{id}', 'OtherCostController@destroy')->name('destroy.other.cost');
    });

//=======================Report Managment==========================
    Route::group([ 'namespace' => 'Report', 'prefix' => 'reports'], function (){
        //-------Monthly Profit--------
        Route::get('/view/profit', 'ProfitController@show')->name('report.view.profit');
        Route::get('profit/get', 'ProfitController@profit_get')->name('report.profit.datewise.get');
        Route::get('/profit/pdf', 'ProfitController@profit_pdf')->name('report.profit.pdf');
        //-------Marksheet--------
        Route::get('/view/marksheet', 'MarksheetController@show')->name('report.view.marksheet');
        Route::get('/get/marksheet', 'MarksheetController@get_marksheet')->name('report.get.marksheet');
        //-------Attendance Report--------
        Route::get('/view/attendance', 'AttendanceController@show')->name('report.view.attendance');
        Route::get('/get/attendance', 'AttendanceController@get_attendance')->name('report.get.attendance');
        //-------Students Result--------
        Route::get('/view/result', 'ResultController@show')->name('report.view.result');
        Route::get('/get/result', 'ResultController@get_result')->name('report.get.result');
        //-------Students ID Card--------
        Route::get('/view/id-card', 'IdCardController@show')->name('report.view.id_card');
        Route::get('/get/id-card', 'IdCardController@get_id_card')->name('report.get.id_card');
        //-------Students Admit Card--------
        Route::get('/view/admit-card', 'AdmitCardController@show')->name('report.view.admit.card');
        Route::get('/get/admit-card', 'AdmitCardController@get_admit_card')->name('report.get.admit.card');


    });

    Route::group([ 'namespace' => 'Sms', 'prefix' => 'sms'], function (){
        //-------Bulk Sms--------
        Route::get('/view/bulk/sms', 'BulkSmsController@show')->name('view.bulk.sms');
        Route::get('/view/sms/student', 'BulkSmsController@get_student')->name('get.sms.student');
        Route::post('/send/bulk/sms', 'BulkSmsController@send')->name('send.bulk.sms');
        //-----teachers sms
        Route::get('/view/teacher', 'BulkSmsController@teacher_show')->name('view.teacher.bulk.sms');
        Route::post('/send/teacher', 'BulkSmsController@teacher_send')->name('send.teacher.bulk.sms');

    });

    Route::group(['prefix' => 'settings'], function (){
        //-------Bulk Sms--------
        Route::get('/view', 'SettingsController@show')->name('view.settings');
        Route::post('/update', 'SettingsController@update')->name('update.settings');

    });


});
