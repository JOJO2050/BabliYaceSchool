<?php

namespace App\Http\Controllers;

use App\Models\ClassSubjectModel;
use App\Models\ClassSubjectTimetableModel;
use App\Models\ClassTeacherModel;
use App\Models\ExamScheduleModel;
use App\Models\User;
use App\Models\WeekModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{

    //Calendrier Student
    public function myCalendar()
    {
        $data["getMyTimetable"] = $this->getTimetable(Auth::user()->class_id); // permet d'afficher l'emploie du temps des matières lier a une classe
        $data["getExamTimetable"] = $this->getExamTimetable(Auth::user()->class_id); // permet d'afficher les examen lier a une classe

        $data["header_title"] = "Mon calendrier";
        return view("student.my_calendar", $data);
    }

    public function getTimetable($class_id)
    {
        $result = array();
        $getRecord = ClassSubjectModel::MySubject($class_id);
        foreach ($getRecord as $value) {
            $dataS["name"] = $value->subject_name;
            $getWeek = WeekModel::getRecord();
            $week = array();
            foreach ($getWeek as $valueW) {
                $dataW = array();
                $dataW["week_name"] = $valueW->name;
                $dataW["fullcalendar_day"] = $valueW->fullcalendar_day;
                $classSubject = ClassSubjectTimetableModel::getRecordClassSubject($value->class_id, $value->subject_id, $valueW->id);

                if (!empty($classSubject)) {
                    $dataW["start_time"] = $classSubject->start_time;
                    $dataW["end_time"] =  $classSubject->end_time;
                    $dataW["room_number"] =  $classSubject->room_number;
                    $week[] = $dataW;
                }
            }

            $dataS["week"] = $week;
            $result[] = $dataS;
        }
        return $result;
    }

    public function getExamTimetable($class_id)
    {

        $getExam = ExamScheduleModel::getExam($class_id);
        $result = array();

        foreach ($getExam as $value) {
            $dataE = array();
            $dataE["name"] = $value->exam_name;

            $getExamTimetable = ExamScheduleModel::getExamTimetable($value->exam_id, $class_id);
            $resultS = array();
            foreach ($getExamTimetable as $valueS) {
                $dataS  = array();
                $dataS["subject_name"] = $valueS->subject_name;
                $dataS["exam_date"] = $valueS->exam_date;
                $dataS["start_time"] = $valueS->start_time;
                $dataS["end_time"] = $valueS->end_time;
                $dataS["room_number"] = $valueS->room_number;
                $dataS["full_marks"] = $valueS->full_marks;
                $dataS["passing_mark"] = $valueS->passing_mark;
                $resultS[] = $dataS;
            }
            $dataE["exam"] = $resultS;
            $result[] = $dataE;
        }
        return $result;
    }


    //Calendrier Parent

    public function  myCalendarParent($student_id)
    {
        $getStudent = User::getSingle($student_id);

        $data["getMyTimetable"] = $this->getTimetable($getStudent->class_id); // permet d'afficher l'emploie du temps des matières lier a une classe
        $data["getExamTimetable"] = $this->getExamTimetable($getStudent->class_id); // permet d'afficher les examen lier a une classe

        $data["getStudent"] = $getStudent;
        $data["header_title"] = "Le calendrier de mon enfant";
        return view("parent.my_calendar", $data);
    }
    //Calendrier Parent

    public function  myCalendarTeacher()
    {
        $teacher_id = Auth::user()->id;

        $data["getClassTimetable"] = ClassTeacherModel::getCalendarTeacher($teacher_id);
        $data["header_title"] = "Mon calendrier";
        return view("teacher.my_calendar", $data);
    }
}
