<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarksRegisterModel extends Model
{
    use HasFactory;

    protected $table = "marks_register";

    /*
 Vérifier si une note existe déjà
    */

    public static function CheckAlreadyMark($student_id, $exam_id, $class_id, $subject_id)
    {
        return self::where("student_id", $student_id)
            ->where("exam_id", $exam_id)
            ->where("class_id", $class_id)
            ->where("subject_id", $subject_id)
            ->first();
    }

    /*
 Examens d'un élève
    */
    public static function getExam($student_id)
    {
        return self::select("marks_register.*", "exam.name as exam_name")
            ->join("exam", "exam.id", "=", "marks_register.exam_id")
            ->where("marks_register.student_id", $student_id)
            ->groupBy("marks_register.exam_id")
            ->orderBy("marks_register.id", "desc")
            ->get();
    }

    /*
 Matières d'un examen pour un élève
    */

    public static function getExamSubject($exam_id, $student_id)
    {
        return self::select("marks_register.*", "exam.name as exam_name", "subject.name as subject_name", "subject.type as subject_type")

            ->join("exam", "exam.id", "=", "marks_register.exam_id")
            ->join("subject", "subject.id", "=", "marks_register.subject_id")
            ->where("marks_register.exam_id", $exam_id)
            ->where("marks_register.student_id", $student_id)
            ->get();
    }

    /*
 Notes d'une matière pour un professeur
 Utilisé pour la saisie des notes
    */
    public static function getTeacherMarks($teacher_id, $exam_id, $class_id, $subject_id)
    {
        return self::select(
            "marks_register.*",
            "student.name as student_name",
            "student.last_name as student_last_name",
            "subject.name as subject_name"
        )
            ->join("users as student", "student.id", "=", "marks_register.student_id")
            ->join("subject", "subject.id", "=", "marks_register.subject_id")
            ->join(
                "assign_class_subject_teacher",
                function ($join) {
                    $join->on(
                        "assign_class_subject_teacher.class_id",
                        "=",
                        "marks_register.class_id"
                    );

                    $join->on(
                        "assign_class_subject_teacher.subject_id",
                        "=",
                        "marks_register.subject_id"
                    );
                }
            )
            ->where("assign_class_subject_teacher.teacher_id", $teacher_id)
            ->where("marks_register.exam_id", $exam_id)
            ->where("marks_register.class_id", $class_id)
            ->where("marks_register.subject_id", $subject_id)
            ->where("assign_class_subject_teacher.status", 0)
            ->where("assign_class_subject_teacher.is_delete", 0)
            ->get();
    }

    /*
 Récupérer toutes les notes d'une classe et matière
    */

    public static function getClassSubjectMarks($exam_id, $class_id, $subject_id)
    {
        return self::where("exam_id", $exam_id)
            ->where("class_id", $class_id)
            ->where("subject_id", $subject_id)
            ->get();
    }
}
