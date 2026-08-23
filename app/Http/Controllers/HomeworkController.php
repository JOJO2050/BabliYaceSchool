<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ClassSubjectModel;
use App\Models\ClassSubjectTeacherModel;
use App\Models\homeworkModel;
use App\Models\SubjectModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class HomeworkController extends Controller
{
    public function HomeworkList(Request $request)
    {
        $data["getClass"] = ClassModel::getClass();
        $data["getAdmin"] = User::where('user_type', 1)
            ->where('is_delete', 0)
            ->orderBy('name', 'asc')
            ->get();

        $data["getRecord"] = homeworkModel::getRecord();
        $data["header_title"] = "Espace de devoir";

        return view('admin/homework/homework_list', $data);
    }

    public function HomeworkAdd()
    {
        $data["getClass"] = ClassModel::getClass();
        $data["header_title"] = "Espace d'ajout de devoir";
        return view('admin/homework/homework_add', $data);
    }

    public function AjaxGetSubjectAdd(Request $request)
    {
        $class_id = $request->class_id;

        $getSubject = ClassSubjectModel::MySubject($class_id);

        if ($getSubject->count() == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Matière non attribuée'
            ]);
        }

        $html = '<option value="">Sélectionner une matière</option>';

        foreach ($getSubject as $value) {
            $html .= '<option value="' . $value->subject_id . '">'
                . $value->subject_name
                . '</option>';
        }

        return response()->json([
            'success' => true,
            'html' => $html
        ]);
    }


    public function HomeworkStore(Request $request)
    {
        $homework = new homeworkModel;
        $homework->class_id = trim($request->class_id);
        $homework->subject_id = trim($request->subject_id);
        $homework->homework_date = trim($request->homework_date);
        $homework->submission_date = trim($request->submission_date);
        $homework->description = trim($request->description);
        $homework->created_by = Auth::user()->id;

        if (!empty($request->file("document_file"))) {
            $ext = $request->file("document_file")->getClientOriginalExtension();
            $file = $request->file("document_file");
            $randomStr = date("Ymdhis") . Str::random(20);
            $filename = strtolower($randomStr) . "." . $ext;
            $file->move("upload/homework/", $filename);

            $homework->document_file = $filename;
        }

        $homework->save();
        return redirect("admin/homework/homework_list")->with("success", "Le Devoir a bien été ajouté ");
    }


    public function HomeworkEdit($id)
    {
        $getRecord =  homeworkModel::getSingle($id);
        $data["getRecord"] = $getRecord;
        $data["getSubject"]  = ClassSubjectModel::MySubject($getRecord->class_id);
        $data["getClass"] = ClassModel::getClass();
        $data["header_title"] = "Espace d'edition du devoir";
        return view('admin/homework/homework_edit', $data);
    }


    public function HomeworkUpdate(Request $request, $id)
    {
        $homework = homeworkModel::getSingle($id);
        $homework->class_id = trim($request->class_id);
        $homework->subject_id = trim($request->subject_id);
        $homework->homework_date = trim($request->homework_date);
        $homework->submission_date = trim($request->submission_date);
        $homework->description = trim($request->description);

        if (!empty($request->file("document_file"))) {
            $ext = $request->file("document_file")->getClientOriginalExtension();
            $file = $request->file("document_file");
            $randomStr = date("Ymdhis") . Str::random(20);
            $filename = strtolower($randomStr) . "." . $ext;
            $file->move("upload/homework/", $filename);

            $homework->document_file = $filename;
        }

        $homework->save();
        return redirect("admin/homework/homework_list")->with("success", "Le Devoir a bien été mis à jour ");
    }

    public function HomeworkDelete($id)
    {
        $homework = homeworkModel::getSingle($id);
        $homework->is_delete = 1;
        $homework->save();

        return redirect()->back()->with("success", "Le Devoir a bien été supprimé ");
    }


    // ESPACE PROFESSEUR

    public function HomeworkTeacherList(Request $request)
    {
        $teacher_id = Auth::user()->id;
        $data["getClass"] = ClassSubjectTeacherModel::getMyClassSubject($teacher_id)
            ->unique('class_id')
            ->values();

        $data["getRecord"] = homeworkModel::getTeacherRecord($teacher_id);
        $data["header_title"] = "Espace de devoir";

        return view('teacher/homework/homework_list', $data);
    }

    public function HomeworkTeacherAdd()
    {
        $teacher_id = Auth::user()->id;
        $data["getClass"] = ClassSubjectTeacherModel::getMyClassGroup($teacher_id);
        $data["header_title"] = "Espace d'ajout de devoir";

        return view('teacher/homework/homework_add', $data);
    }

    public function AjaxGetSubjectTeacherAdd(Request $request)
    {
        $teacher_id = Auth::user()->id;

        $getSubject = ClassSubjectTeacherModel::getSubjectsByTeacherAndClass(
            $teacher_id,
            $request->class_id
        );

        if ($getSubject->count() == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Aucune matière attribuée à cette classe'
            ]);
        }

        $html = '';

        foreach ($getSubject as $value) {
            $html .= '<option value="' . $value->subject_id . '">'
                . $value->subject_name
                . '</option>';
        }

        return response()->json([
            'success' => true,
            'html' => $html
        ]);
    }

    public function HomeworkTeacherStore(Request $request)
    {
        $teacher_id = Auth::user()->id;

        $request->validate([
            'class_id' => 'required|integer',
            'subject_id' => 'required|integer',
            'homework_date' => 'required|date',
            'submission_date' => 'required|date',
            'description' => 'required',
            'document_file' => 'required|file|mimes:pdf|max:10240',
        ]);

        $isAssigned = ClassSubjectTeacherModel::checkTeacherAssignment(
            $teacher_id,
            $request->class_id,
            $request->subject_id
        );

        $homework = new homeworkModel;

        $homework->class_id = $request->class_id;
        $homework->subject_id = $request->subject_id;
        $homework->homework_date = $request->homework_date;
        $homework->submission_date = $request->submission_date;
        $homework->description = $request->description;
        $homework->created_by = $teacher_id;

        if ($request->hasFile('document_file')) {
            $file = $request->file('document_file');
            $ext = $file->getClientOriginalExtension();
            $filename = strtolower(
                date("Ymdhis") . Str::random(20) . "." . $ext
            );

            $file->move("upload/homework/", $filename);
            $homework->document_file = $filename;
        }

        $homework->save();

        return redirect("teacher/homework/homework_list")
            ->with("success", "Votre devoir a bien été ajouté.");
    }


    public function HomeworkTeacherEdit($id)
    {
        $teacher_id = Auth::user()->id;

        $getRecord = homeworkModel::getSingle($id);

        $data["getRecord"] = $getRecord;
        $data["getClass"] = ClassSubjectTeacherModel::getMyClassGroup($teacher_id);
        $data["getSubject"] = ClassSubjectTeacherModel::getSubjectsByTeacherAndClass(
            $teacher_id,
            $getRecord->class_id
        );
        $data["header_title"] = "Espace de modification du devoir";

        return view('teacher/homework/homework_edit', $data);
    }

    public function HomeworkTeacherUpdate(Request $request, $id)
    {

        $homework = homeworkModel::getSingle($id);

        $homework->class_id = trim($request->class_id);
        $homework->subject_id = trim($request->subject_id);
        $homework->homework_date = trim($request->homework_date);
        $homework->submission_date = trim($request->submission_date);
        $homework->description = trim($request->description);

        if (!empty($request->file("document_file"))) {
            $ext = $request->file("document_file")->getClientOriginalExtension();
            $file = $request->file("document_file");
            $randomStr = date("Ymdhis") . Str::random(20);
            $filename = strtolower($randomStr) . "." . $ext;
            $file->move("upload/homework/", $filename);

            $homework->document_file = $filename;
        }

        $homework->save();

        return redirect("teacher/homework/homework_list")
            ->with("success", "Votre devoir a bien été mis à jour");
    }

    public function HomeworkTeacherDelete($id)
    {
        $homework = homeworkModel::getSingle($id);

        $homework->is_delete = 1;
        $homework->save();

        return redirect('teacher/homework/homework_list')
            ->with('success', 'Votre devoir a bien été supprimé');
    }

    //ESPACE ELEVE


    public function HomeworkStudentList()
    {
        $class_id = Auth::user()->class_id;
        $getRecord = HomeworkModel::getStudentRecord($class_id);
        $data['getRecord'] = $getRecord;
        $data['header_title'] = 'Espace de devoir';
        return view('student.homework.homework_list', $data);
    }


    public function SubmitHomework($homework_id)
    {
        $data['getRecord'] = HomeworkModel::getSingle($homework_id);
        $data['header_title'] = 'Espace de soumission de devoir';
        return view('student.homework.homework_submit', $data);
    }

    public function SubmitHomeworkStore($id, Request $request)
    {
        dd($request->all());
    }

    public function AjaxGetSubjectStudentAdd(Request $request)
    {
        $class_id = Auth::user()->class_id;

        if (empty($class_id)) {
            return response()->json([
                'success' => false,
                'message' => 'Aucune classe attribuée à cet élève.'
            ]);
        }

        $subjects = SubjectModel::select('subject.id', 'subject.name')
            ->join('class_subject', 'class_subject.subject_id', '=', 'subject.id')
            ->where('class_subject.class_id', $class_id)
            ->where('subject.is_delete', 0)
            ->orderBy('subject.name', 'asc')
            ->get();

        $html = '';

        foreach ($subjects as $subject) {
            $html .= '<option value="' . $subject->id . '">' .
                e($subject->name) .
                '</option>';
        }

        return response()->json([
            'success' => true,
            'html' => $html
        ]);
    }
}
