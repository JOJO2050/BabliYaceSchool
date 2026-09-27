<?php

namespace App\Http\Controllers;

use App\Models\EtablissementModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EtablissementController extends Controller
{
    public function etablissementList()
    {
        $data["getRecord"] = EtablissementModel::where("is_delete", 0)->first();
        $data["header_title"] = "Configuration de l'établissement";

        return view("admin.parametre.list", $data);
    }


    public function etablissementAdd()
    {
        $data["header_title"] = "Ajouter une configuration";
        return view("admin.parametre.add", $data);
    }

    public function etablissementInsert(Request $request)
    {
        $request->validate([
            "nom" => "required|string|max:191",
            "logo" => "nullable|image|mimes:jpg,jpeg,png,webp|max:2048",
            "url" => "nullable|string|max:150",
            "adresse" => "nullable|string|max:191",
        ]);

        $etablissement = new EtablissementModel();

        $etablissement->nom = $request->nom;
        $etablissement->url = $request->url;
        $etablissement->adresse = $request->adresse;
        $etablissement->is_delete = 0;
        $etablissement->created_by = Auth::id();

        if (!empty($request->file("logo"))) {
            $ext = $request->file("logo")->getClientOriginalExtension();
            $file = $request->file("logo");
            $randomStr = date("Ymdhis") . Str::random(20);
            $filename = strtolower($randomStr) . "." . $ext;
            $file->move("upload/etablissement/", $filename);
            $etablissement->logo = $filename;
        }

        $etablissement->save();

        return redirect("admin/parametre/etablissement")
            ->with("success", "La configuration de l'établissement a été ajoutée avec succès.");
    }

    public function etablissementEdit($id)
    {
        $data["getRecord"] = EtablissementModel::getSingle($id);
        if (empty($data["getRecord"]) || $data["getRecord"]->is_delete == 1) {
            abort(404);
        }

        $data["header_title"] = "Modifier la configuration";
        return view("admin.parametre.edit", $data);
    }

    public function etablissementUpdate($id, Request $request)
    {
        $request->validate([
            "nom" => "required|string|max:191",
            "logo" => "nullable|image|mimes:jpg,jpeg,png,webp|max:2048",
            "url" => "nullable|string|max:150",
            "adresse" => "nullable|string|max:191",
        ]);

        $etablissement = EtablissementModel::getSingle($id);

        if (empty($etablissement) || $etablissement->is_delete == 1) {
            abort(404);
        }

        $etablissement->nom = $request->nom;
        $etablissement->url = $request->url;
        $etablissement->adresse = $request->adresse;

        if (!empty($request->file("logo"))) {
            if (!empty($etablissement->logo)) {
                $oldLogo = public_path("upload/etablissement/" . $etablissement->logo);
                if (file_exists($oldLogo)) {
                    unlink($oldLogo);
                }
            }

            $ext = $request->file("logo")->getClientOriginalExtension();
            $file = $request->file("logo");
            $randomStr = date("Ymdhis") . Str::random(20);
            $filename = strtolower($randomStr) . "." . $ext;
            $file->move("upload/etablissement/", $filename);
            $etablissement->logo = $filename;
        }

        $etablissement->save();
        return redirect("admin/parametre/etablissement")
            ->with("success", "La configuration de l'établissement a été modifiée avec succès.");
    }

    public function etablissementDelete($id)
    {
        $etablissement = EtablissementModel::getSingle($id);
        if (empty($etablissement)) {
            abort(404);
        }

        $etablissement->is_delete = 1;
        $etablissement->save();

        return redirect("admin/parametre/etablissement")
            ->with("success", "La configuration de l'établissement a été supprimée avec succès.");
    }
}
