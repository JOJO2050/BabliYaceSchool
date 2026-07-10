<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ClassSubjectModel;
use App\Models\ClassTeacherModel;
use App\Models\ExamModel;
use App\Models\ExamScheduleModel;
use App\Models\MarksRegisterModel;
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
        $exam->description = trim($request->description);
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
        $exam->description = trim($request->description);

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

    public function marks_register(Request $request)
    {
        $data["getClass"] = ClassModel::getClass();
        $data["getExam"] = ExamModel::getExam();

        $data["getSubject"] = collect();
        $data["getStudent"] = collect();

        if ($request->filled('exam_id') && $request->filled('class_id')) {

            $data["getSubject"] = ExamScheduleModel::getSubject(
                $request->exam_id,
                $request->class_id
            );

            $data["getStudent"] = User::getStudentClass($request->class_id);
        }

        $data["header_title"] = "Liste des devoirs";

        return view("admin.exmination.marks_register", $data);
    }

    public function submit_marks_register(Request $request)
    {
        if (!empty($request->mark)) {

            foreach ($request->mark as $mark) {

                $Interrogation_1 = !empty($mark["Interrogation_1"]) ? $mark["Interrogation_1"] : 0;
                $Interrogation_2 = !empty($mark["Interrogation_2"]) ? $mark["Interrogation_2"] : 0;
                $Devoir_de_classe_1 = !empty($mark["Devoir_de_classe_1"]) ? $mark["Devoir_de_classe_1"] : 0;
                $Devoir_de_classe_2 = !empty($mark["Devoir_de_classe_2"]) ? $mark["Devoir_de_classe_2"] : 0;
                $Devoir_de_niveau = !empty($mark["Devoir_de_niveau"]) ? $mark["Devoir_de_niveau"] : 0;

                // Calcul du total
                $total_marks = $Interrogation_1
                    + $Interrogation_2
                    + $Devoir_de_classe_1
                    + $Devoir_de_classe_2
                    + $Devoir_de_niveau;

                // Récupération du total autorisé
                $getExamSchedule = ExamScheduleModel::getRecordSingle(
                    $request->exam_id,
                    $request->class_id,
                    $mark["subject_id"]
                );

                if (!$getExamSchedule) {
                    return response()->json([
                        'status' => false,
                        'message' => "Configuration de l'évaluation introuvable."
                    ]);
                }

                $full_marks = $getExamSchedule->full_marks;

                // Vérification
                if ($total_marks > $full_marks) {
                    return response()->json([
                        'status' => false,
                        'message' => "La matière dépasse le total autorisé ({$total_marks}/{$full_marks}). Aucun enregistrement n'a été effectué."
                    ]);
                }

                // Vérifie si la note existe déjà
                $getMark = MarksRegisterModel::CheckAlreadyMark(
                    $request->student_id,
                    $request->exam_id,
                    $request->class_id,
                    $mark["subject_id"]
                );

                if ($getMark) {
                    $save = $getMark;
                } else {
                    $save = new MarksRegisterModel();
                    $save->created_by = Auth::user()->id;
                }

                $save->student_id = $request->student_id;
                $save->exam_id = $request->exam_id;
                $save->class_id = $request->class_id;
                $save->subject_id = $mark["subject_id"];
                $save->Interrogation_1 = $Interrogation_1;
                $save->Interrogation_2 = $Interrogation_2;
                $save->Devoir_de_classe_1 = $Devoir_de_classe_1;
                $save->Devoir_de_classe_2 = $Devoir_de_classe_2;
                $save->Devoir_de_niveau = $Devoir_de_niveau;

                $save->save();
            }
        }

        return response()->json([
            'status' => true,
            'message' => "Les notes ont été enregistrées avec succès."
        ]);
    }



    public function single_submit_marks_register(Request $request)
    {
        $id = $request->id;
        $getExamSchedule = ExamScheduleModel::getSingle($id);

        if (empty($getExamSchedule)) {
            return response()->json([
                'status' => false,
                'message' => "Programme d'examen introuvable."
            ]);
        }

        $full_marks = $getExamSchedule->full_marks;

        $Interrogation_1 = !empty($request->Interrogation_1) ? $request->Interrogation_1 : 0;
        $Interrogation_2 = !empty($request->Interrogation_2) ? $request->Interrogation_2 : 0;
        $Devoir_de_classe_1 = !empty($request->Devoir_de_classe_1) ? $request->Devoir_de_classe_1 : 0;
        $Devoir_de_classe_2 = !empty($request->Devoir_de_classe_2) ? $request->Devoir_de_classe_2 : 0;
        $Devoir_de_niveau = !empty($request->Devoir_de_niveau) ? $request->Devoir_de_niveau : 0;

        $total_marks = $Interrogation_1
            + $Interrogation_2
            + $Devoir_de_classe_1
            + $Devoir_de_classe_2
            + $Devoir_de_niveau;

        // Vérification du total
        if ($total_marks > $full_marks) {
            return response()->json([
                'status' => false,
                'message' => "La somme des notes ($total_marks) dépasse le total autorisé ($full_marks). Aucune donnée n'a été enregistrée."
            ]);
        }

        // Vérifie si la note existe déjà
        $getMark = MarksRegisterModel::CheckAlreadyMark(
            $request->student_id,
            $request->exam_id,
            $request->class_id,
            $request->subject_id
        );

        if ($getMark) {
            $save = $getMark;
        } else {
            $save = new MarksRegisterModel();
            $save->created_by = Auth::user()->id;
        }

        $save->student_id = $request->student_id;
        $save->exam_id = $request->exam_id;
        $save->class_id = $request->class_id;
        $save->subject_id = $request->subject_id;
        $save->Interrogation_1 = $Interrogation_1;
        $save->Interrogation_2 = $Interrogation_2;
        $save->Devoir_de_classe_1 = $Devoir_de_classe_1;
        $save->Devoir_de_classe_2 = $Devoir_de_classe_2;
        $save->Devoir_de_niveau = $Devoir_de_niveau;

        $save->save();

        return response()->json([
            'status' => true,
            'message' => "La note de cette matière a bien été enregistrée avec succès."
        ]);
    }


    // public function submit_marks_register(request $request)
    // {
    //     if (!empty($request->mark)) {
    //         foreach ($request->mark as $mark) {

    //             $Interrogation_1 = !empty($mark["Interrogation_1"]) ? $mark["Interrogation_1"] : 0;
    //             $Interrogation_2 = !empty($mark["Interrogation_2"]) ? $mark["Interrogation_2"] : 0;
    //             $Devoir_de_classe_1 = !empty($mark["Devoir_de_classe_1"]) ? $mark["Devoir_de_classe_1"] : 0;
    //             $Devoir_de_classe_2 = !empty($mark["Devoir_de_classe_2"]) ? $mark["Devoir_de_classe_2"] : 0;
    //             $Devoir_de_niveau = !empty($mark["Devoir_de_niveau"]) ? $mark["Devoir_de_niveau"] : 0;

    //             $getMark = MarksRegisterModel::CheckAlreadyMark($request->student_id,  $request->exam_id,  $request->class_id, $mark["subject_id"]);
    //             if (!empty($getMark)) {
    //                 $save = $getMark;
    //             } else {

    //                 $save = new MarksRegisterModel;
    //                 $save->created_by = Auth::user()->id;
    //             }

    //             $save->student_id = $request->student_id;
    //             $save->exam_id = $request->exam_id;
    //             $save->class_id = $request->class_id;
    //             $save->subject_id = $mark["subject_id"];
    //             $save->Interrogation_1 = $Interrogation_1;
    //             $save->Interrogation_2 = $Interrogation_2;
    //             $save->Devoir_de_classe_1 = $Devoir_de_classe_1;
    //             $save->Devoir_de_classe_2 = $Devoir_de_classe_2;
    //             $save->Devoir_de_niveau = $Devoir_de_niveau;
    //             $save->save();
    //         }
    //     }
    //     $json["message"] = "la note a bien été enregistré avec succès ";
    //     echo json_encode($json);
    // }


    // public function single_submit_marks_register(request $request)
    // {
    //     $id = $request->id;
    //     $getExamSchedule = ExamScheduleModel::getSingle($id);

    //     $full_marks = $getExamSchedule->full_marks;

    //     $Interrogation_1 = !empty($request->Interrogation_1) ? $request->Interrogation_1 : 0;
    //     $Interrogation_2 = !empty($request->Interrogation_2) ? $request->Interrogation_2 : 0;
    //     $Devoir_de_classe_1 = !empty($request->Devoir_de_classe_1) ? $request->Devoir_de_classe_1 : 0;
    //     $Devoir_de_classe_2 = !empty($request->Devoir_de_classe_2) ? $request->Devoir_de_classe_2 : 0;
    //     $Devoir_de_niveau = !empty($request->Devoir_de_niveau) ? $request->Devoir_de_niveau : 0;

    //     $total_marks = $Interrogation_1 + $Interrogation_2 + $Devoir_de_classe_1 + $Devoir_de_classe_2  + $Devoir_de_niveau;

    //     if ($full_marks >= $total_marks) {

    //         if (!empty($getMark)) {
    //             $save = $getMark;
    //         } else {

    //             $save = new MarksRegisterModel;
    //             $save->created_by = Auth::user()->id;
    //         }

    //         $save->student_id = $request->student_id;
    //         $save->exam_id = $request->exam_id;
    //         $save->class_id = $request->class_id;
    //         $save->subject_id = $request->subject_id;
    //         $save->Interrogation_1 = $Interrogation_1;
    //         $save->Interrogation_2 = $Interrogation_2;
    //         $save->Devoir_de_classe_1 = $Devoir_de_classe_1;
    //         $save->Devoir_de_classe_2 = $Devoir_de_classe_2;
    //         $save->Devoir_de_niveau = $Devoir_de_niveau;
    //         $save->save();

    //         $json["message"] = "la note de cette matière a bien été enregistré avec succès ";
    //     } else {
    //         $json["message"] = "Felicitation votre notre totale de toutes les evaluations est superieur au total global ";
    //     }
    //     echo json_encode($json);
    // }
}