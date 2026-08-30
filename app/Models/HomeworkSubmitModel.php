<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class HomeworkSubmitModel extends Model
{
    use HasFactory;

    protected $table = "homework_submit";

    static public function getRecord($homework_id)
    {
        $return = HomeworkSubmitModel::select(
            "homework_submit.*",
            "users.id as student_id",
            "class.name as class_name",
            "subject.name as subject_name",
            "users.name as first_name",
            "users.last_name"
        )
            ->join("homework", "homework.id", "=", "homework_submit.homework_id")
            ->join("class", "class.id", "=", "homework.class_id")
            ->join("subject", "subject.id", "=", "homework.subject_id")
            ->join("users", "users.id", "=", "homework_submit.student_id")
            ->where("homework_submit.homework_id", $homework_id);

        // ID élève
        if (!empty(request()->student_id)) {
            $return->where(
                "users.id",
                request()->student_id
            );
        }

        // Nom
        if (!empty(request()->last_name)) {
            $return->where(
                "users.last_name",
                "like",
                "%" . request()->last_name . "%"
            );
        }

        // Prénom
        if (!empty(request()->first_name)) {
            $return->where(
                "users.name",
                "like",
                "%" . request()->first_name . "%"
            );
        }

        // Date d'émission
        if (!empty(request()->homework_date)) {
            $return->whereDate(
                "homework.homework_date",
                request()->homework_date
            );
        }

        // Date de rendu
        if (!empty(request()->submission_date)) {
            $return->whereDate(
                "homework_submit.submission_date",
                request()->submission_date
            );
        }

        return $return
            ->orderBy("homework_submit.id", "desc")
            ->paginate(10)
            ->withQueryString();
    }


    static public function getTeacherRecord($homework_id)
    {
        $return = HomeworkSubmitModel::select(
            "homework_submit.*",
            "users.id as student_id",
            "class.name as class_name",
            "subject.name as subject_name",
            "users.name as first_name",
            "users.last_name"
        )
            ->join("homework", "homework.id", "=", "homework_submit.homework_id")
            ->join("class", "class.id", "=", "homework.class_id")
            ->join("subject", "subject.id", "=", "homework.subject_id")
            ->join("users", "users.id", "=", "homework_submit.student_id")
            ->where("homework_submit.homework_id", $homework_id);

        // Recherche par ID élève
        if (!empty(request()->student_id)) {
            $return->where(
                "users.id",
                request()->student_id
            );
        }

        // Recherche par nom
        if (!empty(request()->last_name)) {
            $return->where(
                "users.last_name",
                "like",
                "%" . request()->last_name . "%"
            );
        }

        // Recherche par prénom
        if (!empty(request()->first_name)) {
            $return->where(
                "users.name",
                "like",
                "%" . request()->first_name . "%"
            );
        }

        // Recherche par date d'émission
        if (!empty(request()->homework_date)) {
            $return->whereDate(
                "homework.homework_date",
                request()->homework_date
            );
        }

        // Recherche par date de rendu
        if (!empty(request()->submission_date)) {
            $return->whereDate(
                "homework_submit.submission_date",
                request()->submission_date
            );
        }

        return $return
            ->orderBy("homework_submit.id", "desc")
            ->paginate(10)
            ->withQueryString();
    }

    public static function getStudentRecord($student)
    {
        $return = HomeworkSubmitModel::select("homework_submit.*",  "class.name as class_name", "subject.name as subject_name")
            ->join("homework", "homework.id", "=", "homework_submit.homework_id")
            ->join("users", "users.id", "=", "homework_submit.student_id")
            ->join("class", "class.id", "=", "homework.class_id")
            ->join("subject", "subject.id", "=", "homework.subject_id")
            ->where("homework_submit.student_id", $student);

        if (!empty(request("subject_id"))) {
            $return->where("homework.subject_id", request("subject_id"));
        }

        if (!empty(request("homework_date"))) {
            $return->whereDate("homework.homework_date", request("homework_date"));
        }

        if (!empty(request("submission_date"))) {
            $return->whereDate("homework.submission_date", request("submission_date"));
        }

        if (!empty(request("sent_date"))) {
            $return->whereDate("homework_submit.created_at", request("sent_date"));
        }

        if (!empty(request("created_by"))) {
            $return->where("homework.created_by", request("created_by"));
        }

        return $return
            ->orderBy("homework_submit.id", "desc")
            ->paginate(10)
            ->appends(request()->query());
    }



    public function getDocument()
    {
        if (
            !empty($this->document_file) &&
            file_exists("upload/homework/" . $this->document_file)
        ) {
            return url("upload/homework/" . $this->document_file);
        }
        return "";
    }

    public function getHomework()
    {
        return $this->belongsTo(HomeworkModel::class, "homework_id");
    }
    public function getStudent()
    {
        return $this->belongsTo(User::class, "student_id");
    }
}
