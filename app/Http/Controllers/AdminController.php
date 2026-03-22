<?php

namespace App\Http\Controllers;

use App\Http\Requests\insertAdminRequest;
use App\Http\Requests\updateAdminResquest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function list()
    {
        $data["getRecord"] = User::getAdmin();
        $data["header_title"] = "Liste administrateur";
        return view("admin.admin.list", $data);
    }


    public function add()
    {
        $data["header_title"] = "Ajouter administrateur";
        return view("admin.admin.add", $data);
    }


    public function insert(insertAdminRequest $request)
    {

        $user = new User();
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

        $user->password = Hash::make($request->password);
        $user->user_type = 1;
        $user->save();
        return redirect("admin/admin/list")->with("success", "L'Administrateur ($user->name ) a bien été ajouté ");
    }

    public function edit($id)
    {
        $data["getRecord"] = User::getSingle($id);

        if (!empty($data["getRecord"])) {
            $data["header_title"] = "Modifier administrateur";
            return view("admin.admin.edit", $data);
        } else {
            abort(404);
        }
    }


    public function update($id,  updateAdminResquest $request, User $user)
    {
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

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        // $user->user_type = 1;
        $user->save();

        return redirect("admin/admin/list")->with("success", "l'Administrateur ($user->name ) a bien été mis a jour ");
    }

    public function delete($id)
    {
        $connectedUser = Auth::user();
        $connectedUserId = $connectedUser->id;

        // Empêcher l'utilisateur connecté de se supprimer lui-même
        if ($connectedUserId == $id) {
            return redirect()->back()
                ->with("error", "Vous ne pouvez pas supprimer l'utilisateur ($connectedUser->name ), car il s'agit de votre propre compte ");
        }
        $user = User::getSingle($id);
        $user->is_delete = 1;
        $user->save();
        return redirect()->back()->with("success", "L'administrateur ($user->name) a été supprimé");
    }
}
