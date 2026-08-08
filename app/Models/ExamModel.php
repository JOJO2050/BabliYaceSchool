<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class ExamModel extends Model
{
    use HasFactory;

    protected $table = "exam";

    /*
     Retourne un examen
    */

    public static function getSingle($id)
    {
        return self::find($id);
    }

    /*
     Liste paginée
    */

    public static function getRecord()
    {
        $query = self::select('exam.*', 'users.name as created_name')
            ->join('users', 'users.id', '=', 'exam.created_by')
            ->where('exam.is_delete', 0);

        if (!empty(Request::get('name'))) {
            $query->where('exam.name', 'like', '%' . Request::get('name') . '%');
        }

        if (!empty(Request::get('date'))) {
            $query->whereDate('exam.created_at', Request::get('date'));
        }

        return $query
            ->orderBy('exam.id', 'desc')
            ->paginate(10);
    }

    /*
     Tous les examens actifs
    */

    public static function getExam()
    {
        return self::where('is_delete', 0)
            ->orderBy('name', 'asc')
            ->get();
    }
}
