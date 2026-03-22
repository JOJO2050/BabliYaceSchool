<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{

    public function list()
    {
        $data["getRecord"] = ClassModel::getRecord();
        $data["header_title"] = "Liste des Classes";
        return view("admin.class.list", $data);
    }

    public function add()
    {
        $data["header_title"] = "Ajouter une Classes";
        return view("admin.class.add", $data);
    }

    public function insert(Request $request)
    {

        $save = new ClassModel();
        $save->name = $request->name;
        $save->status = $request->status;
        $save->created_by = Auth::user()->id;
        $save->save();

        return redirect("admin/class/list")->with("success", "La  Classe ($save->name) est bien enregistrée");
    }


    public function edit($id)
    {
        $data["getRecord"] = ClassModel::getSingle($id);

        if (!empty($data["getRecord"])) {
            $data["header_title"] = "Modifier une Classes";
            return view("admin.class.edit", $data);
        } else {
            abort(404);
        }
    }

    public function update($id,  Request $request)
    {

        $save = ClassModel::getSingle($id);
        $save->name = $request->name;
        $save->status = $request->status;
        $save->save();
        return redirect("admin/class/list")->with("success", "la Classe ($save->name ) a bien été mis a jour ");
    }

    public function delete($id)
    {

        $save = ClassModel::getSingle($id);
        $save->is_delete = 1;
        $save->save();
        return redirect()->back()->with("success", "La classe de ($save->name ) a été supprimé");
    }
}