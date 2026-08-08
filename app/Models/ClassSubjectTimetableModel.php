<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSubjectTimetableModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'subject_id',
        'week_id',
        'start_time',
        'end_time',
        'room_number',
    ];
    protected $table = "class_subject_timetable";

    /*
     Retourne un créneau précis (Classe + Matière + Jour)
    */
    public static function getRecordClassSubject($class_id, $subject_id, $week_id)
    {
        return self::where('class_id', $class_id)
            ->where('subject_id', $subject_id)
            ->where('week_id', $week_id)
            ->first();
    }

    /*
     Retourne tous les créneaux d'une classe
    */
    public static function getClassTimetable($class_id)
    {
        return self::where('class_id', $class_id)
            ->orderBy('week_id')
            ->orderBy('start_time')
            ->get();
    }

    /*
     Retourne tous les créneaux d'une matière
    */
    public static function getSubjectTimetable($class_id, $subject_id)
    {
        return self::where('class_id', $class_id)
            ->where('subject_id', $subject_id)
            ->orderBy('week_id')
            ->orderBy('start_time')
            ->get();
    }

    /*
     Vérifie si un créneau existe
    */
    public static function checkExists($class_id, $subject_id, $week_id)
    {
        return self::where('class_id', $class_id)
            ->where('subject_id', $subject_id)
            ->where('week_id', $week_id)
            ->exists();
    }

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function subject()
    {
        return $this->belongsTo(SubjectModel::class, 'subject_id');
    }

    public function week()
    {
        return $this->belongsTo(WeekModel::class, 'week_id');
    }
}
