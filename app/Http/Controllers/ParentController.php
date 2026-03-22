<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ParentController extends Controller
{
    public function list()
    {
        $data["getRecord"] = User::getParent();
        $data["header_title"] = "Liste des parents";
        return view("admin.parent.list", $data);
    }

    public function add()
    {

        $data["header_title"] = "Ajouter un parent";
        return view("admin.parent.add", $data);
    }

    public function insert(Request $request)
    {
        $parent = new User();
        $parent->name  = trim($request->name);
        $parent->last_name = trim($request->last_name);
        $parent->gender = trim($request->gender);
        $parent->mobile_number = trim($request->mobile_number);

        if (!empty($request->file("profile_pic"))) {
            $ext = $request->file("profile_pic")->getClientOriginalExtension();
            $file = $request->file("profile_pic");
            $randomStr = date("Ymdhis") . Str::random(20);
            $filename = strtolower($randomStr) . "." . $ext;
            $file->move("upload/profile/", $filename);

            $parent->profile_pic = $filename;
        }

        $parent->occupation = trim($request->occupation);
        $parent->address = trim($request->address);

        $parent->status = trim($request->status);
        $parent->email = trim($request->email);
        $parent->password = Hash::make($request->password);
        $parent->user_type = 4;
        $parent->save();
        return redirect("admin/parent/list")->with("success", "Le Parent ($parent->name ) a bien été ajouté ");
    }

    public function edit($id)
    {
        $data["getRecord"] = User::getSingle($id);
        if (!empty($data["getRecord"])) {
            $data["header_title"] = "edition des parents";
            return view("admin.parent.edit", $data);
        } else {
            abort(404);
        }
    }

    public function update($id, Request $request)
    {

        $parent = User::getSingle($id);

        $parent->name  = trim($request->name);
        $parent->last_name = trim($request->last_name);
        $parent->gender = trim($request->gender);
        $parent->mobile_number = trim($request->mobile_number);

        if (!empty($request->file("profile_pic"))) {
            $ext = $request->file("profile_pic")->getClientOriginalExtension();
            $file = $request->file("profile_pic");
            $randomStr = date("Ymdhis") . Str::random(20);
            $filename = strtolower($randomStr) . "." . $ext;
            $file->move("upload/profile/", $filename);

            $parent->profile_pic = $filename;
        }

        $parent->occupation = trim($request->occupation);
        $parent->address = trim($request->address);

        $parent->status = trim($request->status);
        $parent->email = trim($request->email);


        if (!empty($request->password)) {
            $parent->password = Hash::make($request->password);
        }
        $parent->save();
        return redirect("admin/parent/list")->with("success", "La mise à jour du parent ($parent->name ) a bien été éffectué ");
    }

    public function delete($id)
    {
        $getRecord = User::getSingle($id);
        if (!empty(["getRecord"])) {
            $getRecord->is_delete = 1;
            $getRecord->save();
            return redirect()->back()->with("success", "Vous venez de supprimer le parent ($getRecord->name )  ");
        } else {
            abort(404);
        }
    }


    public function myStudent($id)
    {
        $data["getParent"] = User::getSingle($id);
        $data["parent_id"] = $id;
        $data["getRecord"] = User::getMyStudent($id);
        $data["getSearchStudent"] = User::getSearchStudent();

        $data["header_title"] = "Liste des élève lié aux parents";
        return view("admin.parent.my_student", $data);
    }

    public function assignStudentParent($student_id, $parent_id)
    {
        $parent  = User::find($parent_id);
        $student = User::getSingle($student_id);
        $student->parent_id = $parent_id;
        $student->save();

        return redirect()->back()->with(
            "success",
            "Vous avez bien lié l'élève ($student->name $student->last_name) au parent ($parent->name)."
        );
    }


    public function assignStudentParentDelete($student_id,)
    {

        $student = User::getSingle($student_id);
        $student->parent_id = null;
        $student->save();

        return redirect()->back()->with(
            "success",
            " L'élève ($student->name $student->last_name) a bien été supprimé"
        );
    }


    //Espace PARENTS

    public function myStudentParent()
    {
        $id = Auth::user()->id;
        $data["getParent"] = User::getSingle($id);
        $data["getRecord"] = User::getMyStudent($id);

        $data["header_title"] = "Liste de mes enfants";
        return view("parent.my_student", $data);
    }
}
