<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ClassSubjectModel;
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

        $data['header_title'] = "Liste de présence";
        return view('admin.attendance.student', $data);
    }

    public function getSubject(Request $request)
    {
        $subjects = ClassSubjectModel::MySubject($request->class_id);
        return response()->json($subjects);
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
}
