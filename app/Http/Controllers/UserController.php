<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function My_parameter()
    {

        $data["getRecord"] = User::getSingle(Auth::user()->id);
        $data["header_title"] = "Espace paramètre utilisateur";
        if (Auth::user()->user_type == 1) {
            return view("admin.parameter",  $data);
        } elseif (Auth::user()->user_type == 2) {
            return view("teacher.parameter",  $data);
        } elseif (Auth::user()->user_type == 3) {
            return view("student.parameter",  $data);
        } elseif (Auth::user()->user_type == 4) {
            return view("parent.parameter",  $data);
        }
    }

    public function Update_My_parameter_teacher(Request $request)
    {
        $id = Auth::user()->id;
        $teacher = User::getSingle($id);
        $teacher->name  = trim($request->name);
        $teacher->last_name = trim($request->last_name);
        $teacher->gender = trim($request->gender);

        if (!empty($request->date_of_birth)) {
            $teacher->date_of_birth = trim($request->date_of_birth);
        }

        if (!empty($request->file("profile_pic"))) {
            $ext = $request->file("profile_pic")->getClientOriginalExtension();
            $file = $request->file("profile_pic");
            $randomStr = date("Ymdhis") . Str::random(20);
            $filename = strtolower($randomStr) . "." . $ext;
            $file->move("upload/profile/", $filename);

            $teacher->profile_pic = $filename;
        }

        $teacher->marital_status = trim($request->marital_status);
        $teacher->address = trim($request->address);
        $teacher->mobile_number = trim($request->mobile_number);
        $teacher->permanent_address = trim($request->permanent_address);
        $teacher->qualification = trim($request->qualification);
        $teacher->work_experience = trim($request->work_experience);
        $teacher->email = trim($request->email);

        $teacher->save();
        return redirect()->back()->with("success", "La mise à jour du professeur ($teacher->name ) a bien été éffectué ");
    }

    public function Update_My_parameter_student(Request $request)
    {
        $id = Auth::user()->id;
        $student = User::getSingle($id);
        $student->name  = trim($request->name);
        $student->last_name = trim($request->last_name);
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
        $student->blood_group = trim($request->blood_group);
        $student->heigth = trim($request->heigth);
        $student->weigth = trim($request->weigth);
        $student->email = trim($request->email);

        $student->save();
        return redirect()->back()->with("success", "La mise à jour de l'élève ($student->name $student->last_name) a bien été éffectué ");
    }

    public function Update_My_parameter_parent(Request $request)
    {
        $id = Auth::user()->id;
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
        $parent->email = trim($request->email);


        $parent->save();
        return redirect()->back()->with("success", "La mise à jour de l'élève ($parent->name $parent->last_name) a bien été éffectué ");
    }


    public function Update_My_parameter_admin(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::getSingle($id);
        $user->name  = trim($request->name);
        $user->email = trim($request->email);

        if (!empty($request->file("profile_pic"))) {
            $ext = $request->file("profile_pic")->getClientOriginalExtension();
            $file = $request->file("profile_pic");
            $randomStr = date("Ymdhis") . Str::random(20);
            $filename = strtolower($randomStr) . "." . $ext;
            $file->move("upload/profile/", $filename);

            $user->profile_pic = $filename;
        }

        $user->save();
        return redirect()->back()->with("success", "La mise à jour de l'élève ($user->name $user->last_name) a bien été éffectué ");
    }

    public function profil_detail()
    {
        $data["header_title"] = "Espace detail utilisateur";
        return view("profile.profil_detail",  $data);
    }
    public function change_password()
    {
        $data["header_title"] = "Changement de mot passe";
        return view("profile.change_password",  $data);
    }

    public function update_change_password(Request $request, User $user)
    {
        $user = User::getSingle(Auth::user()->id);

        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect()->back()->with("success", "Felicitation ($user->name ), votre mot de passe a bien été mis a jour !!!");
        } else {
            return redirect()->back()->with("error", " Attention ($user->name ), Erreur ancien mot passe incorect");
        }
    }
}
