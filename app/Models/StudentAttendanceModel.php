<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendanceModel extends Model
{
    use HasFactory;

    protected $table = "student_attendance";

    static public function CheckAlreadyAttendance($class_id, $subject_id, $attendance_date, $student_id)
    {
        return StudentAttendanceModel::where("class_id", "=", $class_id)->where("subject_id", "=", $subject_id)->where("attendance_date", "=", $attendance_date)->where("student_id", "=", $student_id)->first();
    }

    public static function getRecord($request)
    {
        $return = self::select(
            "student_attendance.*",
            "class.name as class_name",
            "subject.name as subject_name",
            "student.name as student_name",
            "student.last_name as student_last_name",
            "createdby.name as created_name"
        )
            ->join("class", "class.id", "=", "student_attendance.class_id")
            ->join("users as student", "student.id", "=", "student_attendance.student_id")
            ->join("users as createdby", "createdby.id", "=", "student_attendance.created_by")
            ->join("subject", "subject.id", "=", "student_attendance.subject_id");

        if ($request->filled('class_id')) {
            $return->where('student_attendance.class_id', $request->class_id);
        }
        if ($request->filled('student_id')) {
            $return->where('student_attendance.student_id', $request->student_id);
        }

        if ($request->filled('subject_id')) {
            $return->where('student_attendance.subject_id', $request->subject_id);
        }

        if ($request->filled('attendance_type')) {
            $return->where('student_attendance.attendance_type', $request->attendance_type);
        }

        if ($request->filled('attendance_date')) {
            $return->whereDate('student_attendance.attendance_date', $request->attendance_date);
        }

        return $return->orderBy('student_attendance.id', 'desc')
            ->paginate(10);
    }
}
