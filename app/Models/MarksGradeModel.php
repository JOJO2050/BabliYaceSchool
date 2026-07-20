<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarksGradeModel extends Model
{
    use HasFactory;
    protected $table = "marks_grade";

    static public function getRecord()
    {
        return  MarksGradeModel::select("marks_grade.*", "users.name as created_name")
            ->join("users", "users.id", "=", "marks_grade.created_by")
            ->get();

        // if (!empty(Request::get("name"))) {
        //     $return = $return->where("exam.name", "like", "%" . Request::get("name") . "%");
        // }

        // if (!empty(Request::get("date"))) {
        //     $return = $return->whereDate("exam.created_at", Request::get("date"));
        // }

        // $return = $return->where("exam.is_delete", "=", 0)
        //     ->orderBy("exam.id", "desc")
        //     ->paginate(10);

        // return $return;
    }
}