<?php

namespace App\Http\Controllers;

use App\Http\Requests\insertAdminRequest;
use App\Http\Requests\insertStudentRequest;
use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentController extends Controller
{

    public function list()
    {
        $data["getRecord"] = User::getStudent();
        $data["header_title"] = "Liste des élèves";
        return view("admin.student.list", $data);
    }


    public function add()
    {
        $data["getClass"] = ClassModel::getClass();
        $data["header_title"] = "Ajouter élèves";
        return view("admin.student.add", $data);
    }



    public function insert(Request $request)
    {
        $student = new User();
        $student->name  = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->admission_number = trim($request->admission_number);
        $student->roll_number = trim($request->roll_number);
        $student->class_id = trim($request->class_id);
        $student->gender = trim($request->gender);

        if (!empty($request->date_of_birth)) {
            $student->date_of_birth = trim($request->date_of_birth);
        }

        if (!empty($request->file("profile_pic"))) {
            $ext = $request->file("profile_pic")->getClientOriginalExtension();
            $file = $request->file("profile_pic");
            $randomStr = date("Ymdhis") . Str::random(20);
            $filename = strtolower($randomStr) . "." . $ext;
            $file->move("upload/profile/", $filename);

            $student->profile_pic = $filename;
        }

        $student->caste = trim($request->caste);
        $student->religion = trim($request->religion);
        $student->mobile_number = trim($request->mobile_number);

        if (!empty($request->admission_date)) {
            $student->admission_date = trim($request->admission_date);
        }
        $student->blood_group = trim($request->blood_group);
        $student->heigth = trim($request->heigth);
        $student->weigth = trim($request->weigth);
        $student->status = trim($request->status);
        $student->email = trim($request->email);
        $student->password = Hash::make($request->password);
        $student->user_type = 3;
        $student->save();
        return redirect("admin/student/list")->with("success", "L'élève ($student->name ) a bien été ajouté ");
    }


    public function edit($id)
    {
        $data["getRecord"] = User::getSingle($id);
        if (!empty($data["getRecord"])) {
            $data["getClass"] = ClassModel::getClass();
            $data["header_title"] = "edition des élèves";
            return view("admin.student.edit", $data);
        } else {
            abort(404);
        }
    }

    public function update($id, Request $request)
    {

        $student = User::getSingle($id);
        $student->name  = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->admission_number = trim($request->admission_number);
        $student->roll_number = trim($request->roll_number);
        $student->class_id = trim($request->class_id);
        $student->gender = trim($request->gender);

        if (!empty($request->date_of_birth)) {
            $student->date_of_birth = trim($request->date_of_birth);
        }




        if (!empty($request->file("profile_pic"))) {

            if (!empty($student->getProfile())) {
                unlink("upload/profile/" . $student->profile_pic);
            }

            $ext = $request->file("profile_pic")->getClientOriginalExtension();
            $file = $request->file("profile_pic");
            $randomStr = date("Ymdhis") . Str::random(20);
            $filename = strtolower($randomStr) . "." . $ext;
            $file->move("upload/profile/", $filename);

            $student->profile_pic = $filename;
        }

        $student->caste = trim($request->caste);
        $student->religion = trim($request->religion);
        $student->mobile_number = trim($request->mobile_number);

        if (!empty($request->admission_date)) {
            $student->admission_date = trim($request->admission_date);
        }
        $student->blood_group = trim($request->blood_group);
        $student->heigth = trim($request->heigth);
        $student->weigth = trim($request->weigth);
        $student->status = trim($request->status);
        $student->email = trim($request->email);
        if (!empty($request->password)) {
            $student->password = Hash::make($request->password);
        }
        $student->save();
        return redirect("admin/student/list")->with("success", "La mise à jour de l'élève ($student->name ) a bien été éffectué ");
    }


    public function delete($id)
    {
        $getRecord = User::getSingle($id);
        if (!empty(["getRecord"])) {
            $getRecord->is_delete = 1;
            $getRecord->save();
            return redirect()->back()->with("success", "Vous venez de supprimer l'élève ($getRecord->name )  ");
        } else {
            abort(404);
        }
    }

    public function MyStudent()
    {
        $data["getRecord"] = User::getStudenTeacher(Auth::user()->id);
        $data["header_title"] = "Liste des élèves";
        return view("teacher.my_student", $data);
    }
}
