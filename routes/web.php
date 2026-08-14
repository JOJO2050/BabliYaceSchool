<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\ClassSubjectTeacherController;
use App\Http\Controllers\ClassTeacherController;
use App\Http\Controllers\ClassTimetableController;
use App\Http\Controllers\CommunicateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExaminationsController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

// Route Non protégées, ou pour avoir accès pas besoin d'authentification 

Route::get("/", [AuthController::class, "login"]);
Route::post("login", [AuthController::class, "AuthLogin"]);
Route::get("logout", [AuthController::class, "logout"]);
Route::get("forgot-password", [AuthController::class, "forgotpassword"]);
Route::post("forgot-password", [AuthController::class, "PostForgotpassword"]);
Route::get("reset/{token}", [AuthController::class, "reset"]);
Route::post("reset/{token}", [AuthController::class, "Postreset"]);


//Changement de mot de passe (change_password) URL
Route::group(["middleware" => "auth"], function () {

    Route::get('profile/profil_detail', [UserController::class, "profil_detail"]);
    Route::get('profile/change_password', [UserController::class, "change_password"]);
    Route::post('profile/change_password', [UserController::class, "update_change_password"]);
});


// les routes definis pour les admins
Route::group(["middleware" => "admin"], function () {

    // Admin URL
    Route::get("/admin/dashboard", [DashboardController::class, "dashboard"]);
    Route::get('admin/admin/list', [AdminController::class, "list"]);
    Route::get('admin/admin/add', [AdminController::class, "add"]);
    Route::post('admin/admin/add', [AdminController::class, "insert"]);
    Route::get('admin/admin/edit/{id}', [AdminController::class, "edit"]);
    Route::post('admin/admin/edit/{id}', [AdminController::class, "update"]);
    Route::get('admin/admin/delete/{id}', [AdminController::class, "delete"]);

    // Teacher URL
    Route::get('admin/teacher/list', [TeacherController::class, "list"]);
    Route::get('admin/teacher/add', [TeacherController::class, "add"]);
    Route::post('admin/teacher/add', [TeacherController::class, "insert"]);
    Route::get('admin/teacher/edit/{id}', [TeacherController::class, "edit"]);
    Route::post('admin/teacher/edit/{id}', [TeacherController::class, "update"]);
    Route::get('admin/teacher/delete/{id}', [TeacherController::class, "delete"]);

    // Student URL
    Route::get('admin/student/list', [StudentController::class, "list"]);
    Route::get('admin/student/add', [StudentController::class, "add"]);
    Route::post('admin/student/add', [StudentController::class, "insert"]);
    Route::get('admin/student/edit/{id}', [StudentController::class, "edit"]);
    Route::post('admin/student/edit/{id}', [StudentController::class, "update"]);
    Route::get('admin/student/delete/{id}', [StudentController::class, "delete"]);

    // Parent URL
    Route::get('admin/parent/list', [ParentController::class, "list"]);
    Route::get('admin/parent/add', [ParentController::class, "add"]);
    Route::post('admin/parent/add', [ParentController::class, "insert"]);
    Route::get('admin/parent/edit/{id}', [ParentController::class, "edit"]);
    Route::post('admin/parent/edit/{id}', [ParentController::class, "update"]);
    Route::get('admin/parent/delete/{id}', [ParentController::class, "delete"]);
    Route::get('admin/parent/my_student/{id}', [ParentController::class, "myStudent"]);
    Route::get('admin/parent/assign_student_parent/{student_id}/{parent_id}', [ParentController::class, "assignStudentParent"]);
    Route::get('admin/parent/assign_student_parent_delete/{student_id}', [ParentController::class, "assignStudentParentDelete"]);

    // Class URL
    Route::get('admin/class/list', [ClassController::class, "list"]);
    Route::get('admin/class/add', [ClassController::class, "add"]);
    Route::post('admin/class/add', [ClassController::class, "insert"]);
    Route::get('admin/class/edit/{id}', [ClassController::class, "edit"]);
    Route::post('admin/class/edit/{id}', [ClassController::class, "update"]);
    Route::get('admin/class/delete/{id}', [ClassController::class, "delete"]);

    // Matière (Subject) URL
    Route::get('admin/subject/list', [SubjectController::class, "list"]);
    Route::get('admin/subject/add', [SubjectController::class, "add"]);
    Route::post('admin/subject/add', [SubjectController::class, "insert"]);
    Route::get('admin/subject/edit/{id}', [SubjectController::class, "edit"]);
    Route::post('admin/subject/edit/{id}', [SubjectController::class, "update"]);
    Route::get('admin/subject/delete/{id}', [SubjectController::class, "delete"]);

    // Liaison Classe - Matière - Professeur
    Route::get('admin/assign_class_subject_teacher/list', [ClassSubjectTeacherController::class, 'list']);
    Route::get('admin/assign_class_subject_teacher/add', [ClassSubjectTeacherController::class, 'add']);
    Route::post('admin/assign_class_subject_teacher/add', [ClassSubjectTeacherController::class, 'insert']);
    Route::get('admin/assign_class_subject_teacher/edit/{id}', [ClassSubjectTeacherController::class, 'edit']);
    Route::post('admin/assign_class_subject_teacher/edit/{id}', [ClassSubjectTeacherController::class, 'update']);
    Route::get('admin/assign_class_subject_teacher/delete/{id}', [ClassSubjectTeacherController::class, 'delete']);

    // Ajax : récupérer les matières d'une classe
    Route::get('admin/assign_class_subject_teacher/get_subjects/{class_id}', [ClassSubjectTeacherController::class, 'getSubjects']);

    //Liaisons Classe & Matière (Assign_Subject) URL
    Route::get('admin/assign_subject/list', [ClassSubjectController::class, "list"]);
    Route::get('admin/assign_subject/add', [ClassSubjectController::class, "add"]);
    Route::post('admin/assign_subject/add', [ClassSubjectController::class, "insert"]);
    Route::get('admin/assign_subject/edit/{id}', [ClassSubjectController::class, "edit"]);
    Route::post('admin/assign_subject/edit/{id}', [ClassSubjectController::class, "update"]);
    Route::get('admin/assign_subject/edit_single/{id}', [ClassSubjectController::class, "edit_single"]);
    Route::post('admin/assign_subject/edit_single/{id}', [ClassSubjectController::class, "update_single"]);
    Route::get('admin/assign_subject/delete/{id}', [ClassSubjectController::class, "delete"]);

    //Emploi du temps (class_timetable) URL
    Route::get('admin/class_timetable/list', [ClassTimetableController::class, "list"]);
    Route::post('admin/class_timetable/get_subject', [ClassTimetableController::class, "get_subject"]);
    Route::post('admin/class_timetable/add', [ClassTimetableController::class, "insert_update"]);

    // //Liaisons Classe & Professeur (assign_class_teacher) URL
    // Route::get('admin/assign_class_teacher/list', [ClassTeacherController::class, "list"]);
    // Route::get('admin/assign_class_teacher/add', [ClassTeacherController::class, "add"]);
    // Route::post('admin/assign_class_teacher/add', [ClassTeacherController::class, "insert"]);
    // Route::get('admin/assign_class_teacher/edit/{id}', [ClassTeacherController::class, "edit"]);
    // Route::post('admin/assign_class_teacher/edit/{id}', [ClassTeacherController::class, "update"]);
    // Route::get('admin/assign_class_teacher/edit_single/{id}', [ClassTeacherController::class, "edit_single"]);
    // Route::post('admin/assign_class_teacher/edit_single/{id}', [ClassTeacherController::class, "update_single"]);
    // Route::get('admin/assign_class_teacher/delete/{id}', [ClassTeacherController::class, "delete"]);

    // Examination URL
    Route::get('admin/examination/exam/list', [ExaminationsController::class, "exam_list"]);
    Route::get('admin/examination/exam/add', [ExaminationsController::class, "exam_add"]);
    Route::post('admin/examination/exam/add', [ExaminationsController::class, "exam_insert"]);
    Route::get('admin/examination/exam/edit/{id}', [ExaminationsController::class, "exam_edit"]);
    Route::post('admin/examination/exam/edit/{id}', [ExaminationsController::class, "exam_update"]);
    Route::get('admin/examination/exam/delete/{id}', [ExaminationsController::class, "exam_delete"]);

    // Examination exam_schedule
    Route::get('admin/examination/exam_schedule', [ExaminationsController::class, "exam_schedule"]);
    Route::post('admin/examination/exam_schedule_insert', [ExaminationsController::class, "exam_schedule_insert"]);

    // Edition personnel du profil ADMIN
    Route::get("admin/parameter", [UserController::class, "My_parameter"]);
    Route::post("admin/parameter", [UserController::class, "Update_My_parameter_admin"]);

    // Examination marks_register Gestion des types d'evaluation
    Route::get('admin/examination/marks_register', [ExaminationsController::class, "marks_register"]);
    Route::post('admin/examination/submit_marks_register', [ExaminationsController::class, "submit_marks_register"]);
    Route::post('admin/examination/single_submit_marks_register', [ExaminationsController::class, "single_submit_marks_register"]);

    // Observation des Notes obtenuent
    Route::get('admin/exmination/marks_grade', [ExaminationsController::class, "marks_grade"]);
    Route::get('admin/exmination/marks_grade/add', [ExaminationsController::class, "marks_grade_add"]);
    Route::post('admin/exmination/marks_grade/add', [ExaminationsController::class, "marks_grade_insert"]);
    Route::get('admin/exmination/marks_grade/edit/{id}', [ExaminationsController::class, "marks_grade_edit"]);
    Route::post('admin/exmination/marks_grade/edit/{id}', [ExaminationsController::class, "marks_grade_update"]);
    Route::get('admin/exmination/marks_grade/delete/{id}', [ExaminationsController::class, "marks_grade_delete"]);

    //Gestion des pésences des élèves debut
    Route::get('admin/attendance/get-subject', [AttendanceController::class, "getSubject"]);
    Route::get('admin/attendance/student', [AttendanceController::class, "AttendanceStudent"]);
    Route::post('admin/attendance/student/save', [AttendanceController::class, "AttendanceStudentSubmit"]);
    Route::get('admin/attendance/report', [AttendanceController::class, "AttendanceReport"]);
    //Gestion des pésences des élèves fin


    //Gestion des envoies de mail 
    Route::get('admin/communicate/notice_board/list', [CommunicateController::class, "NoticeBoard"]);
    Route::get('admin/communicate/notice_board/add', [CommunicateController::class, "AddNoticeBoard"]);
    Route::post('admin/communicate/notice_board/add', [CommunicateController::class, "InsertNoticeBoard"]);
});


// les routes definis pour les professeurs
Route::group(["middleware" => "teacher"], function () {

    Route::get("/teacher/dashboard", [DashboardController::class, "dashboard"]);

    // Mes classes et matières PROFESSEUR
    Route::get("teacher/my_class_subject", [ClassSubjectTeacherController::class, "MyClassSubject"]);

    // emploie du temps selon la classe du PROFESSEUR
    Route::get('teacher/my_class_subject/class_timetable/{class_id}/{subject_id}', [ClassTimetableController::class, "myTimetableTeacher"]);

    // Mes classes et matières PROFESSEUR
    Route::get("teacher/my_student", [StudentController::class, "MyStudent"]);

    // Calendrier des devoirs
    Route::get("teacher/my_exam_timetable", [ExaminationsController::class, "myExamTimetableTeacher"]);

    // Edition personnel du profil PROFESSEUR
    Route::get("teacher/parameter", [UserController::class, "My_parameter"]);
    Route::post("teacher/parameter", [UserController::class, "Update_My_parameter_teacher"]);

    //Calendrier  Teacher
    Route::get("teacher/my_calendar", [CalendarController::class, "myCalendarTeacher"]);

    // Examination marks_register Gestion des types d'evaluation
    Route::get('teacher/marks_register', [ExaminationsController::class, "marks_register_teacher"]);
    Route::post('teacher/submit_marks_register', [ExaminationsController::class, "submit_marks_register"]);
    Route::post('teacher/single_submit_marks_register', [ExaminationsController::class, "single_submit_marks_register"]);

    //Gestion des pésences des élèves debut
    Route::get('teacher/attendance/get-subject', [AttendanceController::class, "getSubject"]);

    Route::get('teacher/attendance/student', [AttendanceController::class, "AttendanceStudentTeacher"]);
    Route::post('teacher/attendance/student/save', [AttendanceController::class, "AttendanceStudentSubmitTeacher"]);

    Route::get('teacher/attendance/report', [AttendanceController::class, "AttendanceTeacherReport"]);

    //Gestion des pésences des élèves fin
});


// les routes definis pour les élèves
Route::group(["middleware" => "student"], function () {

    Route::get("/student/dashboard", [DashboardController::class, "dashboard"]);
    // Recuperation des matières liés a l'élève connecté dans son espace
    Route::get("student/my_subject", [SubjectController::class, "mySubjectStudent"]);
    // espace emploi du temps
    Route::get("student/my_timetable", [ClassTimetableController::class, "myTimetableStudent"]);
    // Calendrier des devoirs
    Route::get("student/my_exam_timetable", [ExaminationsController::class, "myExamTimetableStudent"]);
    // Edition personnel du profil ELEVE
    Route::get("student/parameter", [UserController::class, "My_parameter"]);
    Route::post("student/parameter", [UserController::class, "Update_My_parameter_student"]);
    //Calendrier
    Route::get("student/my_calendar", [CalendarController::class, "myCalendar"]);
    //Resultats des evaluations
    Route::get("student/my_exam_result", [ExaminationsController::class, "myExamResult"]);
    //Liste de présence
    Route::get("student/my_attendance", [AttendanceController::class, "myStudentAttendance"]);
});



// les routes definis pour les parents
Route::group(["middleware" => "parent"], function () {

    Route::get("/parent/dashboard", [DashboardController::class, "dashboard"]);
    // Recuperation des élèves liés aux parents connecté dans son espace
    Route::get("/parent/my_student/subject/{student_id}", [SubjectController::class, "ParentStudentSubject"]);
    // Recuperation desexamen de chaque élève lier a un âent specifique
    Route::get("/parent/my_student/exam_timetable/{student_id}", [ExaminationsController::class, "ExamTimetableStudentForParent"]);
    // Recuperation de l'emploie du temps des élèves liés aux parents connecté dans son espace
    Route::get('parent/my_student/subject/class_timetable/{class_id}/{subject_id}/{student_id}', [ClassTimetableController::class, "myTimetableParent"]);
    //Resultat des Evaluations
    Route::get("parent/my_student/exam_result/{student_id}", [ExaminationsController::class, "ParentmyExamResult"]);
    // Recuperation des matières liés a chaque élève lié au parent connecté dans son espace
    Route::get("parent/my_student", [ParentController::class, "myStudentParent"]);

    //Calendrier
    Route::get("parent/my_student/calendar/{student_id}", [CalendarController::class, "myCalendarParent"]);

    //Liste de présence
    Route::get("parent/my_student/my_attendance/{student_id}", [AttendanceController::class, "myParentAttendance"]);

    // Edition personnel du profil PARENT
    Route::get("parent/parameter", [UserController::class, "My_parameter"]);
    Route::post("parent/parameter", [UserController::class, "Update_My_parameter_parent"]);
});