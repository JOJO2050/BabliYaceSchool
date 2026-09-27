<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ClassSubjectModel;
use App\Models\ClassSubjectTeacherModel;
use App\Models\StudentAttendanceModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function AttendanceStudent(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getSubject'] = [];
        $data['getStudent'] = [];

        // Charger les matières de la classe
        if (!empty($request->class_id)) {
            $data['getSubject'] = ClassSubjectModel::MySubject($request->class_id);
        }

        // Charger les élèves uniquement si la classe et la date sont renseignées
        if (!empty($request->class_id) && !empty($request->attendance_date)) {
            $data['getStudent'] = User::getStudentByClassAttendance($request->class_id);
        }

        $data['header_title'] = "Boite email";
        return view('admin.attendance.student', $data);
    }
    public function getSubject(Request $request)
    {
        $class_id = $request->get('class_id');

        if (empty($class_id)) {
            return response()->json([]);
        }

        $user = Auth::user();

        // ADMIN
        if ($user->user_type == 1) {

            // L'administrateur voit toutes les matières de la classe
            $getSubject = ClassSubjectModel::MySubject($class_id);
        }

        // PROFESSEUR
        elseif ($user->user_type == 2) {

            // Le professeur voit uniquement les matières
            // qui lui sont attribuées dans cette classe
            $getSubject = ClassSubjectTeacherModel::getSubjectsByTeacherAndClass(
                $user->id,
                $class_id
            );
        }

        // AUTRES UTILISATEURS
        else {

            $getSubject = collect();
        }

        return response()->json($getSubject);
    }
    public function AttendanceStudentSubmit(Request $request)
    {
        $check_attendance = StudentAttendanceModel::CheckAlreadyAttendance($request->class_id, $request->subject_id, $request->attendance_date, $request->student_id);

        if (!empty($check_attendance)) {
            $attendance = $check_attendance;
        } else {
            $attendance = new StudentAttendanceModel;
            $attendance->class_id = $request->class_id;
            $attendance->subject_id = $request->subject_id;
            $attendance->attendance_date = $request->attendance_date;
            $attendance->student_id = $request->student_id;
            $attendance->created_by = Auth::user()->id;
        }


        $attendance->attendance_type = $request->attendance_type;
        $attendance->save();

        return response()->json([
            'status' => true,
            'message' => 'Pointage de présence bien enregistré.'
        ]);
    }
    public function AttendanceReport(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getSubject'] = [];
        $data['getRecord'] = [];

        // Charger les matières de la classe sélectionnée
        if ($request->filled('class_id')) {
            $data['getSubject'] = ClassSubjectModel::MySubject($request->class_id);
        }

        // Charger les résultats uniquement après une recherche
        if (
            $request->filled('class_id') ||
            $request->filled('student_id') ||
            $request->filled('subject_id') ||
            $request->filled('attendance_type') ||
            $request->filled('attendance_date')
        ) {
            $data['getRecord'] = StudentAttendanceModel::getRecord($request);
        }

        $data['header_title'] = "Rapport de présence";
        return view('admin.attendance.report', $data);
    }


    //Espace Professeur
    public function AttendanceStudentTeacher(Request $request)
    {
        $teacher_id = Auth::user()->id;

        $data['getClassSubject'] = ClassSubjectTeacherModel::getMyClassSubject($teacher_id);
        $data['getStudent'] = collect();
        $data['subject_id'] = '';
        $data['subject_name'] = '';

        if ($request->filled('class_id')) {

            $classSubject = ClassSubjectTeacherModel::where('teacher_id', $teacher_id)
                ->where('class_id', $request->class_id)
                ->where('is_delete', 0)
                ->where('status', 0)
                ->first();

            if (!empty($classSubject)) {

                $data['subject_id'] = $classSubject->subject_id;

                $subject = ClassSubjectModel::select('class_subject.subject_id', 'subject.name as subject_name')
                    ->join('subject', 'subject.id', '=', 'class_subject.subject_id')
                    ->where('class_subject.class_id', $request->class_id)
                    ->where('class_subject.subject_id', $classSubject->subject_id)
                    ->where('class_subject.status', 0)
                    ->where('class_subject.is_delete', 0)
                    ->where('subject.status', 0)
                    ->where('subject.is_delete', 0)
                    ->first();

                if (!empty($subject)) {
                    $data['subject_name'] = $subject->subject_name;
                }

                if ($request->filled('attendance_date')) {
                    $data['getStudent'] = User::getStudentByClassAttendance($request->class_id);
                }
            }
        }

        $data['header_title'] = "Liste de présence";
        return view('teacher.attendance.student', $data);
    }
    public function AttendanceStudentSubmitTeacher(Request $request)
    {
        $check_attendance = StudentAttendanceModel::CheckAlreadyAttendance(
            $request->class_id,
            $request->subject_id,
            $request->attendance_date,
            $request->student_id
        );

        if (!empty($check_attendance)) {

            $attendance = $check_attendance;
            $attendance->created_by = Auth::id();
        } else {

            $attendance = new StudentAttendanceModel();

            $attendance->class_id = $request->class_id;
            $attendance->subject_id = $request->subject_id;
            $attendance->attendance_date = $request->attendance_date;
            $attendance->student_id = $request->student_id;

            $attendance->created_by = Auth::id();
        }

        $attendance->attendance_type = $request->attendance_type;
        $attendance->save();

        return response()->json([
            'status' => true,
            'message' => 'Pointage de présence bien enregistré.'
        ]);
    }
    public function AttendanceTeacherReport(Request $request)
    {
        $teacher_id = Auth::id();

        $teacherSubjects = ClassSubjectTeacherModel::getSubjectsTeacher($teacher_id);

        $data['getClass'] = $teacherSubjects
            ->unique('class_id')
            ->values();

        $data['getSubject'] = [];
        $data['getRecord'] = collect();

        if ($request->filled('class_id')) {
            $data['getSubject'] = $teacherSubjects
                ->where('class_id', $request->class_id)
                ->values();
        }

        $hasSearch = $request->filled('class_id')
            || $request->filled('subject_id')
            || $request->filled('student_id')
            || $request->filled('attendance_type')
            || $request->filled('attendance_date');

        if ($hasSearch) {

            $query = StudentAttendanceModel::select(
                'student_attendance.*',
                'users.name as student_name',
                'users.last_name as student_last_name',
                'class.name as class_name',
                'subject.name as subject_name',
                'creator.name as created_name'
            )
                ->join('users', 'users.id', '=', 'student_attendance.student_id')
                ->join('class', 'class.id', '=', 'student_attendance.class_id')
                ->join('subject', 'subject.id', '=', 'student_attendance.subject_id')
                ->leftJoin('users as creator', 'creator.id', '=', 'student_attendance.created_by')
                ->join(
                    'assign_class_subject_teacher',
                    function ($join) use ($teacher_id) {
                        $join->on('assign_class_subject_teacher.class_id', '=', 'student_attendance.class_id');
                        $join->on('assign_class_subject_teacher.subject_id', '=', 'student_attendance.subject_id');
                        $join->where('assign_class_subject_teacher.teacher_id', '=', $teacher_id);
                        $join->where('assign_class_subject_teacher.status', '=', 0);
                        $join->where('assign_class_subject_teacher.is_delete',  '=', 0);
                    }
                );

            if ($request->filled('class_id')) {
                $query->where('student_attendance.class_id', $request->class_id);
            }

            if ($request->filled('subject_id')) {
                $query->where('student_attendance.subject_id', $request->subject_id);
            }

            if ($request->filled('student_id')) {
                $query->where('student_attendance.student_id', $request->student_id);
            }

            if ($request->filled('attendance_type')) {
                $query->where('student_attendance.attendance_type', $request->attendance_type);
            }

            if ($request->filled('attendance_date')) {
                $query->whereDate('student_attendance.attendance_date', $request->attendance_date);
            }

            $data['getRecord'] = $query
                ->orderBy('student_attendance.attendance_date', 'desc')
                ->paginate(10)
                ->appends($request->except('page'));
        }

        $data['header_title'] = "Rapport de présence";
        return view('teacher.attendance.report', $data);
    }


    //Espace Elève
    public function myStudentAttendance(Request $request)
    {
        $student_id = Auth::id();
        $data["header_title"] = "Ma liste de présence";
        $data["getSubject"] = StudentAttendanceModel::getStudentSubjects($student_id);
        $data["getRecord"] = collect();

        $hasSearch = $request->filled("subject_id")
            || $request->filled("attendance_type")
            || $request->filled("attendance_date");

        if ($hasSearch) {
            $data["getRecord"] = StudentAttendanceModel::getStudentRecord(
                $student_id,
                $request
            );
        }

        return view("student.my_attendance", $data);
    }


    //Epace Parent

    public function myParentAttendance(Request $request, $student_id)
    {
        $data["header_title"] = "Présence de l'élève";

        $data["getStudent"] = User::select(
            "users.*",
            "class.name as class_name"
        )
            ->join("class", "class.id", "=", "users.class_id")
            ->where("users.id", $student_id)
            ->first();

        if (empty($data["getStudent"])) {
            return redirect()->back()->with(
                "error",
                "Élève introuvable."
            );
        }

        $data["getSubject"] = StudentAttendanceModel::getStudentSubjects(
            $student_id
        );

        // Par défaut : aucune recherche
        $data["getRecord"] = collect();

        // Vérifier si le parent a effectué une recherche
        $hasSearch = $request->filled("subject_id")
            || $request->filled("attendance_type")
            || $request->filled("attendance_date");

        if ($hasSearch) {

            $data["getRecord"] = StudentAttendanceModel::getParentStudentRecord(
                $student_id,
                $request
            );
        }

        return view(
            "parent.my_attendance",
            $data
        );
    }
}