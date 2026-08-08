<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamScheduleModel extends Model
{
    use HasFactory;

    protected $table = "exam_schedule";


    /*
     Récupérer une programmation d'examen
    */

    public static function getSingle($id)
    {
        return self::find($id);
    }

    /*
     Vérifier si une matière est déjà programmée
    */

    public static function getRecordSingle($exam_id, $class_id, $subject_id)
    {
        return self::where("exam_id", $exam_id)
            ->where("class_id", $class_id)
            ->where("subject_id", $subject_id)
            ->first();
    }

    /*
     Supprimer les programmations d'une classe
    */

    public static function deleteRecord($exam_id, $class_id)
    {
        return self::where("exam_id", $exam_id)
            ->where("class_id", $class_id)
            ->delete();
    }

    /*
     Liste des examens d'une classe
    */

    public static function getExam($class_id)
    {
        return self::select("exam_schedule.*", "exam.name as exam_name")
            ->join("exam", "exam.id", "=", "exam_schedule.exam_id")
            ->where("exam_schedule.class_id", $class_id)
            ->groupBy("exam_schedule.exam_id")
            ->orderBy("exam_schedule.id", "desc")
            ->get();
    }

    /*
     Examens accessibles par un professeur
     Nouvelle logique :
     Classe + Matière + Professeur
     Remplace assign_class_teacher
    
    */
    public static function getExamTeacher($teacher_id)
    {
        return self::select("exam_schedule.*", "exam.name as exam_name")
            ->join("exam", "exam.id", "=", "exam_schedule.exam_id")
            ->join(
                "assign_class_subject_teacher",
                function ($join) {
                    $join->on(
                        "assign_class_subject_teacher.class_id",
                        "=",
                        "exam_schedule.class_id"
                    );

                    $join->on(
                        "assign_class_subject_teacher.subject_id",
                        "=",
                        "exam_schedule.subject_id"
                    );
                }
            )
            ->where("assign_class_subject_teacher.teacher_id", $teacher_id)
            ->where("assign_class_subject_teacher.status", 0)
            ->where("assign_class_subject_teacher.is_delete", 0)
            ->groupBy("exam_schedule.exam_id")
            ->orderBy("exam_schedule.id", "desc")
            ->get();
    }

    /*
     Emploi du temps complet d'un examen
    */

    public static function getExamTimetable($exam_id, $class_id)
    {
        return self::select("exam_schedule.*", "subject.name as subject_name", "subject.type as subject_type")
            ->join("subject", "subject.id", "=", "exam_schedule.subject_id")
            ->where("exam_schedule.exam_id", $exam_id)
            ->where("exam_schedule.class_id", $class_id)
            ->get();
    }

    /*
     Liste des matières d'un examen
    */

    public static function getSubject($teacher_id, $exam_id, $class_id)
    {
        return self::select("exam_schedule.*", "subject.name as subject_name", "subject.type as subject_type")
            ->join("subject", "subject.id", "=", "exam_schedule.subject_id")
            ->join(
                "assign_class_subject_teacher",
                function ($join) {
                    $join->on(
                        "assign_class_subject_teacher.class_id",
                        "=",
                        "exam_schedule.class_id"
                    );
                    $join->on(
                        "assign_class_subject_teacher.subject_id",
                        "=",
                        "exam_schedule.subject_id"
                    );
                }
            )
            ->where("exam_schedule.exam_id", $exam_id)
            ->where("exam_schedule.class_id", $class_id)
            ->where("assign_class_subject_teacher.teacher_id", $teacher_id)
            ->where("assign_class_subject_teacher.status", 0)
            ->where("assign_class_subject_teacher.is_delete", 0)
            ->get();
    }


    public static function getSubjectAdmin($exam_id, $class_id)
    {
        return self::select("exam_schedule.*", "subject.name as subject_name", "subject.type as subject_type")
            ->join("subject", "subject.id", "=", "exam_schedule.subject_id")
            ->where("exam_schedule.exam_id", $exam_id)
            ->where("exam_schedule.class_id", $class_id)
            ->get();
    }

    /*
     Récupérer les matières d'examen d'un professeur
     Utilisé pour la saisie des notes
    
    */
    public static function getTeacherSubjectsExam($teacher_id, $exam_id)
    {
        return self::select("exam_schedule.*", "class.name as class_name", "subject.name as subject_name")
            ->join("class", "class.id", "=", "exam_schedule.class_id")
            ->join("subject", "subject.id", "=", "exam_schedule.subject_id")
            ->join(
                "assign_class_subject_teacher",
                function ($join) {
                    $join->on(
                        "assign_class_subject_teacher.class_id",
                        "=",
                        "exam_schedule.class_id"
                    );

                    $join->on(
                        "assign_class_subject_teacher.subject_id",
                        "=",
                        "exam_schedule.subject_id"
                    );
                }
            )
            ->where("exam_schedule.exam_id", $exam_id)
            ->where("assign_class_subject_teacher.teacher_id", $teacher_id)
            ->where("assign_class_subject_teacher.status", 0)
            ->where("assign_class_subject_teacher.is_delete", 0)
            ->get();
    }

    /*
     Vérifier une note existante
    */

    public static function getMark($student_id, $exam_id, $class_id, $subject_id)
    {
        return MarksRegisterModel::CheckAlreadyMark($student_id, $exam_id, $class_id, $subject_id);
    }


    public static function getTeacherExamTimetable($exam_id, $class_id, $teacher_id)
    {
        return self::select("exam_schedule.*", "subject.name as subject_name", "subject.type as subject_type")
            ->join("subject", "subject.id", "=", "exam_schedule.subject_id")
            ->join(
                "assign_class_subject_teacher",
                function ($join) {
                    $join->on(
                        "assign_class_subject_teacher.class_id",
                        "=",
                        "exam_schedule.class_id"
                    );
                    $join->on(
                        "assign_class_subject_teacher.subject_id",
                        "=",
                        "exam_schedule.subject_id"
                    );
                }
            )
            ->where("exam_schedule.exam_id", $exam_id)
            ->where("exam_schedule.class_id", $class_id)
            ->where("assign_class_subject_teacher.teacher_id", $teacher_id)
            ->where("assign_class_subject_teacher.status", 0)
            ->where("assign_class_subject_teacher.is_delete", 0)
            ->get();
    }
}
