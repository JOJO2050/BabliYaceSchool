<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSubjectTeacherModel extends Model
{
    use HasFactory;

    protected $table = "assign_class_subject_teacher";


    protected $fillable = [
        'class_id',
        'subject_id',
        'teacher_id',
        'status',
        'is_delete',
        'created_by'
    ];

    /*
    Relations
    */

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }
    public function subject()
    {
        return $this->belongsTo(SubjectModel::class, 'subject_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }


    public function timetable()
    {
        return $this->hasMany(ClassSubjectTimetableModel::class, 'class_id', 'class_id')
            ->whereColumn('class_subject_timetable.subject_id', 'assign_class_subject_teacher.subject_id');
    }

    /*
    CRUD
    */

    public static function getSingle($id)
    {
        return self::where('id', $id)
            ->where('is_delete', 0)
            ->first();
    }

    public static function deleteRecord($id)
    {
        return self::where('id', $id)
            ->update([
                'is_delete' => 1
            ]);
    }

    /*
    Vérifier affectation existante
    */

    public static function getAlreadyAssigned($class_id, $subject_id, $teacher_id)
    {
        return self::where('class_id', $class_id)
            ->where('subject_id', $subject_id)
            ->where('teacher_id', $teacher_id)
            ->where('is_delete', 0)
            ->first();
    }

    /*
    Matières professeur
    */

    // public static function getSubjectsTeacher($teacher_id)
    // {

    //     return self::select(
    //         'assign_class_subject_teacher.*',
    //         'class.name as class_name',
    //         'class.id as class_id',
    //         'subject.name as subject_name',
    //         'subject.id as subject_id',
    //         'subject.type as subject_type'
    //     )
    //         ->join('class', 'class.id', '=', 'assign_class_subject_teacher.class_id')
    //         ->join('subject', 'subject.id', '=', 'assign_class_subject_teacher.subject_id')
    //         ->where('assign_class_subject_teacher.teacher_id', $teacher_id)
    //         ->where('assign_class_subject_teacher.status', 0)
    //         ->where('assign_class_subject_teacher.is_delete', 0)
    //         ->orderBy('class.name')
    //         ->orderBy('subject.name')

    //         ->get();
    // }



    /*
    Calendrier professeur
    */

    public static function getCalendarTeacher($teacher_id)
    {
        return self::select('class_subject_timetable.*', 'class.name as class_name', 'subject.name as subject_name', 'week.name as week_name', 'week.fullcalendar_day')
            ->join('class', 'class.id', '=', 'assign_class_subject_teacher.class_id')
            ->join('subject', 'subject.id', '=', 'assign_class_subject_teacher.subject_id')
            ->join(
                'class_subject_timetable',
                function ($join) {
                    $join->on('class_subject_timetable.class_id', '=', 'assign_class_subject_teacher.class_id');
                    $join->on('class_subject_timetable.subject_id', '=', 'assign_class_subject_teacher.subject_id');
                }
            )
            ->join('week', 'week.id', '=', 'class_subject_timetable.week_id')
            ->where('assign_class_subject_teacher.teacher_id', $teacher_id)
            ->where('assign_class_subject_teacher.status', 0)
            ->where('assign_class_subject_teacher.is_delete', 0)
            ->distinct()
            ->orderBy('class_subject_timetable.week_id')
            ->orderBy('class_subject_timetable.start_time')
            ->get();
    }


    public static function getSubjectsTeacher($teacher_id)
    {
        return self::select(
            'assign_class_subject_teacher.*',
            'class.name as class_name',
            'class.id as class_id',
            'subject.name as subject_name',
            'subject.id as subject_id',
            'subject.type as subject_type'
        )
            ->join(
                'class',
                'class.id',
                '=',
                'assign_class_subject_teacher.class_id'
            )
            ->join(
                'subject',
                'subject.id',
                '=',
                'assign_class_subject_teacher.subject_id'
            )
            ->where(
                'assign_class_subject_teacher.teacher_id',
                $teacher_id
            )
            ->where(
                'assign_class_subject_teacher.status',
                0
            )
            ->where(
                'assign_class_subject_teacher.is_delete',
                0
            )
            ->orderBy('class.name')
            ->orderBy('subject.name')
            ->get();
    }

    public static function getSubjectsByTeacherAndClass($teacher_id, $class_id)
    {
        return self::select(
            'assign_class_subject_teacher.subject_id',
            'subject.name as subject_name'
        )
            ->join(
                'subject',
                'subject.id',
                '=',
                'assign_class_subject_teacher.subject_id'
            )
            ->where(
                'assign_class_subject_teacher.teacher_id',
                $teacher_id
            )
            ->where(
                'assign_class_subject_teacher.class_id',
                $class_id
            )
            ->where(
                'assign_class_subject_teacher.status',
                0
            )
            ->where(
                'assign_class_subject_teacher.is_delete',
                0
            )
            ->where(
                'subject.status',
                0
            )
            ->where(
                'subject.is_delete',
                0
            )
            ->orderBy('subject.name')
            ->get();
    }
    /*
    Emploi du temps matière
    */

    public static function getMyTimeTable($class_id, $subject_id)
    {

        return ClassSubjectTimetableModel::where('class_id', $class_id)
            ->where('subject_id', $subject_id)
            ->orderBy('week_id')
            ->orderBy('start_time')
            ->get();
    }

    /*
    Liste admin
    */

    public static function getRecord($request)
    {
        $query = self::select(
            'assign_class_subject_teacher.*',
            'class.name as class_name',
            'subject.name as subject_name',
            'teacher.name as teacher_name',
            'teacher.last_name as teacher_last_name',
            'creator.name as created_by_name'
        )

            ->join('class', 'class.id', '=', 'assign_class_subject_teacher.class_id')
            ->join('subject', 'subject.id', '=', 'assign_class_subject_teacher.subject_id')
            ->join('users as teacher', 'teacher.id', '=', 'assign_class_subject_teacher.teacher_id')
            ->join('users as creator', 'creator.id', '=', 'assign_class_subject_teacher.created_by')
            ->where('assign_class_subject_teacher.is_delete', 0);

        if (!empty($request->class_name)) {
            $query->where('class.name', 'like', '%' . $request->class_name . '%');
        }


        if (!empty($request->subject_name)) {
            $query->where('subject.name', 'like', '%' . $request->subject_name . '%');
        }

        if (!empty($request->teacher_name)) {
            $query->where(function ($q) use ($request) {
                $q->where('teacher.name', 'like', '%' . $request->teacher_name . '%')
                    ->orWhere('teacher.last_name', 'like', '%' . $request->teacher_name . '%');
            });
        }

        return $query
            ->orderBy('assign_class_subject_teacher.id', 'desc')
            ->paginate(10);
    }

    /*
    Mes classes et matières professeur
    */

    public static function getMyClassSubject($teacher_id)
    {
        return self::select(
            'assign_class_subject_teacher.*',
            'class.name as class_name',
            'class.id as class_id',
            'subject.name as subject_name',
            'subject.id as subject_id',
            'subject.type as subject_type'
        )
            ->join('class', 'class.id', '=', 'assign_class_subject_teacher.class_id')
            ->join('subject', 'subject.id', '=', 'assign_class_subject_teacher.subject_id')
            ->where('assign_class_subject_teacher.teacher_id', $teacher_id)
            ->where('assign_class_subject_teacher.status', 0)
            ->where('assign_class_subject_teacher.is_delete', 0)
            ->where('subject.status', 0)
            ->where('subject.is_delete', 0)
            ->orderBy('class.name')
            ->orderBy('subject.name')
            ->get();
    }

    /*
| Classes du professeur (pour examens, calendrier, etc.)
*/

    public static function getMyClassGroup($teacher_id)
    {
        return self::select('assign_class_subject_teacher.class_id', 'class.name as class_name')

            ->join('class', 'class.id', '=', 'assign_class_subject_teacher.class_id')
            ->where('assign_class_subject_teacher.teacher_id', $teacher_id)
            ->where('assign_class_subject_teacher.status', 0)
            ->where('assign_class_subject_teacher.is_delete', 0)
            ->groupBy('assign_class_subject_teacher.class_id', 'class.name')
            ->get();
    }

    public static function checkTeacherAssignment($teacher_id, $class_id, $subject_id)
    {
        return self::where('teacher_id', $teacher_id)
            ->where('class_id', $class_id)
            ->where('subject_id', $subject_id)
            ->where('status', 0)
            ->where('is_delete', 0)
            ->exists();
    }
}
