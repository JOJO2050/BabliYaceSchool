<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class ClassModel extends Model
{
    use HasFactory;
    // Table associée
    protected $table = "class";

    static public function getSingle($id)
    {
        return self::find($id);
    }


    static public function getRecord()
    {
        $return = ClassModel::select("class.*", "users.name as created_by_name")
            ->join("users", "users.id", "class.created_by");
        if (!empty(Request::get("name"))) {
            $return = $return->where("class.name", "like", "%" . Request::get("name") . "%");
        }
        if (!empty(Request::get("date"))) {
            $return = $return->whereDate("class.created_at", "=", Request::get("date"));
        }
        $return = $return->where("class.is_delete", "=", 0)
            ->orderBy("class.id", "desc")
            ->paginate(10);
        return  $return;
    }

    static public function getClass()
    {
        $return = ClassModel::select("class.*")
            ->join("users", "users.id", "class.created_by")
            ->where("class.is_delete", "=", 0)
            ->where("class.status", "=", 0)
            ->orderBy("class.name", "asc")
            ->get();
        return  $return;
    }
    static public function getTotalClass()
    {
        $return = ClassModel::select("class.id")
            ->join("users", "users.id", "class.created_by")
            ->where("class.is_delete", "=", 0)
            ->where("class.status", "=", 0)
            ->count();
        return  $return;
    }

    static public function getClassStatistics()
    {
        return self::select(
            "class.id",
            "class.name",
            DB::raw("COUNT(users.id) as student_count")
        )
            ->leftJoin("users", function ($join) {
                $join->on("users.class_id", "=", "class.id")
                    ->where("users.user_type", 3)
                    ->where("users.is_delete", 0);
            })
            ->where("class.is_delete", 0)
            ->where("class.status", 0)
            ->groupBy("class.id", "class.name")
            ->orderBy("class.id", "asc")
            ->get();
    }
}
