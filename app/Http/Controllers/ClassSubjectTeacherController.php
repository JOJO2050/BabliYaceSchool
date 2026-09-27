<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ClassSubjectModel;
use App\Models\ClassSubjectTeacherModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassSubjectTeacherController extends Controller
{

    public function list(Request $request)
    {
        $data['getRecord'] = ClassSubjectTeacherModel::getRecord($request);
        $data['header_title'] = "Liaison Classe - Matière - Professeur";

        return view('admin.assign_class_subject_teacher.list', $data);
    }

    // Charger les matières d'une classe avec AJAX
    public function getSubjects($class_id)
    {
        $subjects = ClassSubjectModel::select('subject.id','subject.name','assign_class_subject_teacher.teacher_id')
            ->join('subject', 'subject.id', '=', 'class_subject.subject_id')
            ->leftJoin('assign_class_subject_teacher', function ($join) use ($class_id) {

                $join->on('assign_class_subject_teacher.subject_id','=', 'class_subject.subject_id');
                $join->where('assign_class_subject_teacher.class_id','=',$class_id);
                $join->where('assign_class_subject_teacher.is_delete','=',0);})

            ->where('class_subject.class_id', $class_id)
            ->where('class_subject.status', 0)
            ->where('class_subject.is_delete', 0)
            ->where('subject.status', 0)
            ->where('subject.is_delete', 0)
            ->get();

        return response()->json($subjects);
    }


    public function add()
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getTeacher'] = User::getTeacherClass();
        $data['header_title'] = "Ajouter une liaison Classe - Matière - Professeur";

        return view('admin.assign_class_subject_teacher.add', $data);
    }

    public function insert(Request $request)
    {
        if (!empty($request->teacher)) {

            foreach ($request->teacher as $subject_id => $teacher_id) {
                if (!empty($teacher_id)) {
                    $save = ClassSubjectTeacherModel::where('class_id', $request->class_id)
                        ->where('subject_id', $subject_id)
                        ->where('is_delete', 0)
                        ->first();

                    if (!empty($save)) {

                        // On remplace le professeur existant
                        $save->teacher_id = $teacher_id;
                        $save->status = $request->status ?? 0;
                        $save->save();
                    } else {

                        // Nouvelle liaison
                        $save = new ClassSubjectTeacherModel;

                        $save->class_id = $request->class_id;
                        $save->subject_id = $subject_id;
                        $save->teacher_id = $teacher_id;
                        $save->status = $request->status ?? 0;
                        $save->created_by = Auth::user()->id;

                        $save->save();
                    }
                }
            }

            return redirect('admin/assign_class_subject_teacher/list')
                ->with('success', 'La liaison a été enregistrée');
        }

        return back()->with('error', 'Veuillez sélectionner les professeurs');
    }

    public function edit($id)
    {
        $getRecord = ClassSubjectTeacherModel::getSingle($id);

        if (!empty($getRecord)) {
            $data['getRecord'] = $getRecord;
            $data['getClass'] = ClassModel::getClass();
            $data['getTeacher'] = User::getTeacherClass();
            $data['getSubjects'] = ClassSubjectModel::select('subject.id', 'subject.name')
                ->join('subject', 'subject.id', '=', 'class_subject.subject_id')
                ->where('class_subject.class_id', $getRecord->class_id)
                ->where('class_subject.status', 0)
                ->where('class_subject.is_delete', 0)
                ->get();

            $data['header_title'] = "Modifier liaison Classe - Matière - Professeur";
            return view('admin.assign_class_subject_teacher.edit', $data);
        } else {

            abort(404);
        }
    }

    public function update(Request $request, $id)
    {
        $save = ClassSubjectTeacherModel::getSingle($id);

        if (!empty($save)) {
            
            // Chercher si cette classe + matière possède déjà un autre professeur
            $oldRecord = ClassSubjectTeacherModel::where('class_id', $request->class_id)
                ->where('subject_id', $request->subject_id)
                ->where('id', '!=', $id)
                ->where('is_delete', 0)
                ->first();

            if (!empty($oldRecord)) {

                // On supprime l'ancien enregistrement
                $oldRecord->is_delete = 1;
                $oldRecord->save();
            }

            $save->class_id = $request->class_id;
            $save->subject_id = $request->subject_id;
            $save->teacher_id = $request->teacher_id;
            $save->status = $request->status;

            $save->save();

            return redirect('admin/assign_class_subject_teacher/list')
                ->with('success', 'La liaison a été mise à jour');
        }

        return back()->with('error', 'Liaison introuvable');
    }

    public function delete($id)
    {
        $record = ClassSubjectTeacherModel::getSingle($id);
        if (!empty($record)) {
            $record->is_delete = 1;
            $record->save();
        }
        return back()->with('success', 'La liaison a été supprimée');
    }

        public function MyClassSubject()
    {
        $data["getRecord"] = ClassSubjectTeacherModel::getMyClassSubject(Auth::user()->id);
        $data["header_title"] = "Mes Classe & Matières";
        return view("teacher.my_class_subject", $data);
    }
}