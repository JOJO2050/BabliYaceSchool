<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class homeworkModel extends Model
{
    use HasFactory;

    protected $table = "homework";

    static public function getSingle($id)
    {
        return self::find($id);
    }


    static public function getRecord()
    {
        $query = self::select(
            "homework.*",
            "class.name as class_name",
            "subject.name as subject_name",
            "users.name as created_by_name"
        )
            ->join("users", "users.id", "=", "homework.created_by")
            ->join("class", "class.id", "=", "homework.class_id")
            ->join("subject", "subject.id", "=", "homework.subject_id")
            ->where("homework.is_delete", 0);

        if (!empty(request('class_id'))) {
            $query->where(
                'homework.class_id',
                request('class_id')
            );
        }

        if (!empty(request('subject_id'))) {
            $query->where(
                'homework.subject_id',
                request('subject_id')
            );
        }

        if (!empty(request('created_by'))) {
            $query->where(
                'homework.created_by',
                request('created_by')
            );
        }

        if (!empty(request('homework_date'))) {
            $query->whereDate(
                'homework.homework_date',
                request('homework_date')
            );
        }

        if (!empty(request('submission_date'))) {
            $query->whereDate(
                'homework.submission_date',
                request('submission_date')
            );
        }

        return $query
            ->orderBy("homework.id", "desc")
            ->paginate(10)
            ->appends(request()->query());
    }



    public function getDocument()
    {
        if (!empty($this->document_file) && file_exists("upload/homework/" . $this->document_file)) {
            return url("upload/homework/" . $this->document_file);
        } else {
            return "";
        }
    }


    public static function getTeacherRecord($teacher_id)
    {
        $query = self::select(
            "homework.*",
            "class.name as class_name",
            "subject.name as subject_name",
            "users.name as created_by_name"
        )
            ->join("users", "users.id", "=", "homework.created_by")
            ->join("class", "class.id", "=", "homework.class_id")
            ->join("subject", "subject.id", "=", "homework.subject_id")
            ->join("assign_class_subject_teacher", function ($join) use ($teacher_id) {
                $join->on(
                    "assign_class_subject_teacher.class_id",
                    "=",
                    "homework.class_id"
                );
                $join->on(
                    "assign_class_subject_teacher.subject_id",
                    "=",
                    "homework.subject_id"
                );
                $join->where(
                    "assign_class_subject_teacher.teacher_id",
                    "=",
                    $teacher_id
                );
            })
            ->where("homework.is_delete", 0)
            ->where("assign_class_subject_teacher.status", 0)
            ->where("assign_class_subject_teacher.is_delete", 0);

        if (!empty(request('class_id'))) {
            $query->where(
                "homework.class_id",
                request('class_id')
            );
        }

        if (!empty(request('subject_id'))) {
            $query->where(
                "homework.subject_id",
                request('subject_id')
            );
        }

        if (!empty(request('homework_date'))) {
            $query->whereDate(
                "homework.homework_date",
                request('homework_date')
            );
        }

        if (!empty(request('submission_date'))) {
            $query->whereDate(
                "homework.submission_date",
                request('submission_date')
            );
        }

        return $query
            ->distinct()
            ->orderBy("homework.id", "desc")
            ->paginate(10)
            ->appends(request()->query());
    }


    public static function getStudentRecord($class_id, $student_id)
    {
        $query = self::select(
            "homework.*",
            "class.name as class_name",
            "subject.name as subject_name",
            "users.name as created_by_name"
        )
            ->join("users", "users.id", "=", "homework.created_by")
            ->join("class", "class.id", "=", "homework.class_id")
            ->join("subject", "subject.id", "=", "homework.subject_id")
            ->where("homework.class_id", $class_id)
            ->where("homework.is_delete", 0)
            ->whereNotIn("homework.id", function ($query) use ($student_id) {
                $query->select("homework_id")
                    ->from("homework_submit")
                    ->where("student_id", $student_id);
            });

        if (!empty(request('subject_id'))) {
            $query->where(
                "homework.subject_id",
                request('subject_id')
            );
        }

        if (!empty(request('homework_date'))) {
            $query->whereDate(
                "homework.homework_date",
                request('homework_date')
            );
        }

        if (!empty(request('submission_date'))) {
            $query->whereDate(
                "homework.submission_date",
                request('submission_date')
            );
        }

        return $query
            ->orderBy("homework.id", "desc")
            ->paginate(10)
            ->appends(request()->query());
    }
}
