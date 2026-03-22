<?php

namespace App\Http\Controllers;

use App\Models\ClassSubjectModel;
use App\Models\SubjectModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function list()
    {
        $data["getRecord"] = SubjectModel::getRecord();
        $data["header_title"] = "Liste des Matières";
        return view("admin.subject.list", $data);
    }

    public function add()
    {
        $data["header_title"] = "Ajout des Matières";
        return view("admin.subject.add", $data);
    }


    public function insert(Request $request)
    {
        $save = new SubjectModel();
        $save->name = trim($request->name);
        $save->type = trim($request->type);
        $save->status = trim($request->status);
        $save->created_by = Auth::user()->id;
        $save->save();

        return redirect("admin/subject/list")->with("success", "La  matière ($save->name) est bien enregistrée");
    }

    public function edit($id)
    {
        $data["getRecord"] = SubjectModel::getSingle($id);

        if (!empty($data["getRecord"])) {
            $data["header_title"] = "Modifier une matière";
            return view("admin.subject.edit", $data);
        } else {
            abort(404);
        }
    }

    public function update($id,  Request $request)
    {

        $save =  SubjectModel::getSingle($id);
        $save->name = trim($request->name);
        $save->type = trim($request->type);
        $save->status = trim($request->status);
        $save->save();
        return redirect("admin/subject/list")->with("success", "la Matière ($save->name ) a bien été mis a jour ");
    }

    public function delete($id)
    {

        $save = SubjectModel::getSingle($id);
        $save->is_delete = 1;
        $save->save();
        return redirect()->back()->with("success", "La classe de ($save->name ) a été supprimé");
    }

    //Espace Student 

    public function mySubjectStudent()
    {

        $data["getRecord"] = ClassSubjectModel::MySubject(Auth::user()->class_id);;
        $data["header_title"] = "Mes Matières";
        return view("student.my_subject", $data);
    }


    //Espace Parent
    public function ParentStudentSubject($student_id)
    {
        $user = User::getSingle($student_id);

        $data["getRecord"] = ClassSubjectModel::MySubject($user->class_id);
        $data["getUser"] = $user;
        $data["header_title"] = "Ses Matières";
        return view("parent.my_student_subject", $data);
    }
}
