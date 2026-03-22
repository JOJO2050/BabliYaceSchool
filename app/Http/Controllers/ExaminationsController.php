<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ClassSubjectModel;
use App\Models\ClassTeacherModel;
use App\Models\ExamModel;
use App\Models\ExamScheduleModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExaminationsController extends Controller
{
    public function exam_list()
    {
        $data["getRecord"] = ExamModel::getRecord();
        $data["header_title"] = "Liste des examens";
        return view("admin.exmination.exam.list", $data);
    }

    public function exam_add()
    {
        $data["header_title"] = "Ajouter des examens";
        return view("admin.exmination.exam.add", $data);
    }

    public function exam_insert(Request $request)
    {

        $exam = new ExamModel();
        $exam->name  = trim($request->name);
        $exam->note = trim($request->note);
        $exam->created_by = Auth::user()->id;
        $exam->save();
        return redirect("admin/examination/exam/list")->with("success", "L'examen ($exam->name ) a bien été ajouté ");
    }

    public function exam_edit($id)
    {
        $data["getRecord"] = ExamModel::getSingle($id);

        if (!empty($data["getRecord"])) {
            $data["header_title"] = "Modifier un examen";
            return view("admin.exmination.exam.edit", $data);
        } else {
            abort(404);
        }
    }

    public function exam_update($id,  Request $request)
    {
        $exam = ExamModel::getSingle($id);
        $exam->name  = trim($request->name);
        $exam->note = trim($request->note);

        $exam->save();

        return redirect("admin/examination/exam/list")->with("success", "L'examen ($exam->name ) a bien été mis a jour ");
    }

    public function exam_delete($id)
    {

        $getRecord = ExamModel::getSingle($id);
        if (!empty($getRecord)) {
            $getRecord->is_delete = 1;
            $getRecord->save();
            return redirect()->back()->with("success", "L'examen ($getRecord->name) a été supprimé");
        } else {
            abort(404);
        }
    }

    //En rapport avec le calendrier 
    public function exam_schedule(Request $request)
    {
        $data["getClass"] = ClassModel::getClass();
        $data["getExam"] = ExamModel::getExam();

        $result = array();
        if (!empty($request->get("exam_id")) && !empty($request->get("class_id"))) {
            $getSubject = ClassSubjectModel::MySubject($request->get("class_id"));

            foreach ($getSubject as $value) {
                $dataS = array();
                $dataS["subject_id"] = $value->subject_id;
                $dataS["class_id"] = $value->class_id;
                $dataS["subject_name"] = $value->subject_name;
                $dataS["subject_type"] = $value->subject_type;
                $ExamSchedule = ExamScheduleModel::getRecordSingle($request->get("exam_id"), $request->get("class_id"), $value->subject_id);

                if (!empty($ExamSchedule)) {
                    $dataS["exam_date"] = $ExamSchedule->exam_date;
                    $dataS["start_time"] = $ExamSchedule->start_time;
                    $dataS["end_time"] = $ExamSchedule->end_time;
                    $dataS["room_number"] = $ExamSchedule->room_number;
                    $dataS["full_marks"] = $ExamSchedule->full_marks;
                    $dataS["passing_mark"] = $ExamSchedule->passing_mark;
                } else {
                    $dataS["exam_date"] = "";
                    $dataS["start_time"] = "";
                    $dataS["end_time"] = "";
                    $dataS["room_number"] = "";
                    $dataS["full_marks"] = "";
                    $dataS["passing_mark"] = "";
                }

                $result[] = $dataS;
            }
        }
        $data["getRecord"] = $result;

        $data["header_title"] = "Calendrier des examens";
        return view("admin.exmination.exam_schedule", $data);
    }

    public function exam_schedule_insert(Request $request)
    {
        ExamScheduleModel::deleteRecord($request->exam_id, $request->class_id);

        if (!empty($request->schedule)) {

            foreach ($request->schedule as $schedule) {
                if (!empty($schedule["subject_id"]) && !empty($schedule["exam_date"]) && !empty($schedule["start_time"]) && !empty($schedule["end_time"]) && !empty($schedule["room_number"]) && !empty($schedule["full_marks"]) && !empty($schedule["passing_mark"])) {
                    $exam = new ExamScheduleModel;
                    $exam->exam_id = $request->exam_id;
                    $exam->class_id = $request->class_id;
                    $exam->subject_id = $schedule["subject_id"];
                    $exam->exam_date = $schedule["exam_date"];
                    $exam->start_time = $schedule["start_time"];
                    $exam->end_time = $schedule["end_time"];
                    $exam->room_number = $schedule["room_number"];
                    $exam->full_marks = $schedule["full_marks"];
                    $exam->passing_mark = $schedule["passing_mark"];
                    $exam->passing_mark = $schedule["passing_mark"];
                    $exam->created_by = Auth::user()->id;
                    $exam->save();
                }
            }
        }
        return redirect()->back()->with("success", "Le programme de l'examen  a été crée");
    }


    //En rapport avec le calendrier des examen mais espace Elève
    public function myExamTimetableStudent(Request $requet)
    {
        $class_id = Auth::user()->class_id;
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
        $data["getRecord"] = $result;

        $data["header_title"] = "Calendrier des  examens";
        return view("student.my_exam_timetable", $data);
    }


    //En rapport avec le calendrier des examen mais espace Professeur
    public function myExamTimetableTeacher(Request $request)
    {
        $getClass = ClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);

        $result = array(); // création du tableau final

        foreach ($getClass as $class) {

            $examArray = array(); // reset pour chaque classe

            $dataC = array();
            $dataC["class_name"] = $class->class_name;

            $getExam = ExamScheduleModel::getExam($class->class_id);

            foreach ($getExam as $exam) {

                $dataE = array();
                $dataE["exam_name"] = $exam->exam_name;

                $getExamTimetable = ExamScheduleModel::getExamTimetable($exam->exam_id, $class->class_id);

                $subjectArray = array();

                foreach ($getExamTimetable as $valueS) {

                    $dataS  = array();
                    $dataS["subject_name"] = $valueS->subject_name;
                    $dataS["exam_date"] = $valueS->exam_date;
                    $dataS["start_time"] = $valueS->start_time;
                    $dataS["end_time"] = $valueS->end_time;
                    $dataS["room_number"] = $valueS->room_number;
                    $dataS["full_marks"] = $valueS->full_marks;
                    $dataS["passing_mark"] = $valueS->passing_mark;

                    $subjectArray[] = $dataS;
                }

                $dataE["subject"] = $subjectArray;

                $examArray[] = $dataE;
            }

            $dataC["exam"] = $examArray;

            $result[] = $dataC;
        }

        $data["getRecord"] = $result;

        $data["header_title"] = "Calendrier des examens";

        return view("teacher.my_exam_timetable", $data);
    }

    //ExamTimetableStudentForParent la fonction qui permet de recuperer les examens de chaque élève lié a un parent bien précis
    public function ExamTimetableStudentForParent($student_id)
    {
        $getStudent = User::getSingle($student_id);
        $class_id = $getStudent->class_id;
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
        $data["getRecord"] = $result;
        $data["getStudent"] = $getStudent;

        $data["header_title"] = "Calendrier des  examens de chaque de mon élève";
        return view("parent.my_exam_timetable", $data);
    }
}
