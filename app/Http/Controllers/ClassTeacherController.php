<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ClassTeacherModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassTeacherController extends Controller
{
    public function list()
    {
        $data["getRecord"] = ClassTeacherModel::getRecord();
        $data["header_title"] = "Liaison classe et professeur";
        return view("admin.assign_class_teacher.list", $data);
    }

    public function add()
    {
        $data["getClass"] = ClassModel::getClass();
        $data["getTeacher"] = User::getTeacherClass();
        $data["header_title"] = "Ajout de liaison classe et professeur";
        return view("admin.assign_class_teacher.add", $data);
    }

    public function insert(Request $request)
    {

        if (!empty($request->teacher_id)) {

            foreach ($request->teacher_id as $teacher_id) {
                $getAlreadyFirst = ClassTeacherModel::getAlreadyFirst($request->class_id, $teacher_id);
                if (!empty($getAlreadyFirst)) {
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();
                } else {
                    $save = new ClassTeacherModel;
                    $save->class_id = $request->class_id;
                    $save->teacher_id = $teacher_id;
                    $save->status = $request->status;
                    $save->created_by = Auth::user()->id;
                    $save->save();
                }
            }
            return redirect("admin/assign_class_teacher/list")->with("success", "La liaison classe_professeur de a été enregistré");
        } else {
            return redirect()->back()->with("error", "Veillez ressayer une erreur est suvenue");
        }
    }

    public function edit($id)
    {
        $getRecord = ClassTeacherModel::getSingle($id);
        if (!empty($getRecord)) {

            $data["getRecord"] = $getRecord;
            $data["getAssignTeacherID"] = ClassTeacherModel::getAssignTeacherID($getRecord->class_id);
            $data["getClass"] = ClassModel::getClass();
            $data["getTeacher"] = User::getTeacherClass();
            $data["header_title"] = "Editer la liaison classe et professeur";
            return view("admin.assign_class_teacher.edit", $data);
        } else {
            abort(404);
        }
    }


    public function update(Request $request)
    {

        ClassTeacherModel::deleteTeacher($request->class_id);

        if (!empty($request->teacher_id)) {

            foreach ($request->teacher_id as $teacher_id) {
                $getAlreadyFirst = ClassTeacherModel::getAlreadyFirst($request->class_id, $teacher_id);
                if (!empty($getAlreadyFirst)) {
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();
                } else {
                    $save = new ClassTeacherModel;
                    $save->class_id = $request->class_id;
                    $save->teacher_id = $teacher_id;
                    $save->status = $request->status;
                    $save->created_by = Auth::user()->id;
                    $save->save();
                }
            }
        }
        return redirect("admin/assign_class_teacher/list")->with("success", "La liaison classe_professeur  a été mis à jour");
    }


    public function edit_single($id)
    {
        $getRecord = ClassTeacherModel::getSingle($id);
        if (!empty($getRecord)) {

            $data["getRecord"] = $getRecord;
            $data["getClass"] = ClassModel::getClass();
            $data["getTeacher"] = User::getTeacher();
            $data["header_title"] = "Edition unique de la liaison classe et professeur ";
            return view("admin.assign_class_teacher.edit_single", $data);
        } else {
            abort(404);
        }
    }


    public function update_single($id, Request $request)
    {

        $getAlreadyFirst = ClassTeacherModel::getAlreadyFirst($request->class_id, $request->teacher_id);
        if (!empty($getAlreadyFirst)) {
            $getAlreadyFirst->status = $request->status;
            $getAlreadyFirst->save();
            return redirect("admin/assign_class_teacher/list")->with("success", "Le status de la liaison classe_professeur a été mis à jour");
        } else {
            $save = ClassTeacherModel::getSingle($id);
            $save->class_id = $request->class_id;
            $save->teacher_id = $request->teacher_id;
            $save->status = $request->status;
            $save->save();
            return redirect("admin/assign_class_teacher/list")->with("success", "La liaison classe_professeur de a été mis à jour");
        }
    }

    public function delete($id)
    {

        $save = ClassTeacherModel::getSingle($id);
        $save->is_delete = 1;
        $save->save();
        return redirect()->back()->with("success", "La liaison classe_professeur de a été supprimé");
    }

    //ESPACE PROFESSEUR

    public function MyClassSubject()
    {
        $data["getRecord"] = ClassTeacherModel::getMyClassSubject(Auth::user()->id);
        $data["header_title"] = "Mes Classe & Matières";
        return view("teacher.my_class_subject", $data);
    }
}