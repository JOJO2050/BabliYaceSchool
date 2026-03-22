<?php

namespace App\Http\Controllers;

use App\Models\ClassSubjectModel;
use App\Models\ClassSubjectTimetableModel;
use App\Models\WeekModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{

    public function myCalendar()
    {

        $result = array();
        $getRecord = ClassSubjectModel::MySubject(Auth::user()->class_id);
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

        $data["getMyTimetable"] = $result;



        $data["header_title"] = "Mon calendrier";
        return view("student.my_calendar", $data);
    }
}
