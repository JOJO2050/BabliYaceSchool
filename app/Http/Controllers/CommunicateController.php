<?php

namespace App\Http\Controllers;

use App\Models\NoticeBoardMessageModel;
use App\Models\NoticeBoardModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunicateController extends Controller
{
    public function NoticeBoard(Request $request)
    {
        $data['getRecord'] = NoticeBoardModel::getRecord();
        $data['header_title'] = "Liste des informations";
        return view('admin.communicate.notice_board.list', $data);
    }

    public function AddNoticeBoard(Request $request)
    {
        $data['header_title'] = "Ajouter une information";
        return view('admin.communicate.notice_board.add', $data);
    }

    //notice_board
    public function InsertNoticeBoard(Request $request)
    {
        $save = new NoticeBoardModel;
        $save->title = $request->title;
        $save->notice_date = $request->notice_date;
        $save->publish_date = $request->publish_date;
        $save->message = $request->message;
        $save->created_by = Auth::user()->id;
        $save->save();

        if (!empty($request->message_to)) {

            foreach ($request->message_to as $message_to) {

                $message = new NoticeBoardMessageModel;
                $message->notice_board_id = $save->id;
                $message->message_to = $message_to;
                $message->save();
            }
        }
        return redirect("admin/communicate/notice_board/list")->with("success", "cette information  a bien été enregistré");
    }

    public function NoticeBoardEdit($id)
    {
        $data['getRecord'] = NoticeBoardModel::getSingle($id);
        $data['header_title'] = "Modifier une information";
        return view('admin.communicate.notice_board.edit', $data);
    }

    public function NoticeBoardUpdate($id, Request $request)
    {
        $save = NoticeBoardModel::getSingle($id);
        $save->title = $request->title;
        $save->notice_date = $request->notice_date;
        $save->publish_date = $request->publish_date;
        $save->message = $request->message;
        $save->save();

        NoticeBoardMessageModel::DeleteRecord($id);

        if (!empty($request->message_to)) {

            foreach ($request->message_to as $message_to) {

                $message = new NoticeBoardMessageModel;
                $message->notice_board_id = $save->id;
                $message->message_to = $message_to;
                $message->save();
            }
        }
        return redirect("admin/communicate/notice_board/list")->with("success", "cette information a bien été mise à jour");
    }

    public function NoticeBoardDelete($id)
    {
        $save = NoticeBoardModel::getSingle($id);
        $save->delete();

        NoticeBoardMessageModel::DeleteRecord($id);

        return redirect()->back()->with("success", "cette information a bien été supprimé");
    }

    //Espace Elève
    public function myNoticeBoardStudent(Request $request)
    {
        $message_to = Auth::user()->user_type;

        $title = trim($request->input('title', ''));
        $notice_date_from = $request->input('notice_date_from', '');
        $notice_date_to = $request->input('notice_date_to', '');

        $getRecord = NoticeBoardModel::getRecordUser(
            $message_to,
            $title,
            $notice_date_from,
            $notice_date_to
        );

        $data['getRecord'] = $getRecord;
        $data['header_title'] = 'Ma liste information';

        return view('student.my_notice_board', $data);
    }


    //Espace Professeur
    public function myNoticeBoardTeacher(Request $request)
    {
        $message_to = Auth::user()->user_type;

        $title = trim($request->input('title', ''));
        $notice_date_from = $request->input('notice_date_from', '');
        $notice_date_to = $request->input('notice_date_to', '');

        $getRecord = NoticeBoardModel::getRecordUser(
            $message_to,
            $title,
            $notice_date_from,
            $notice_date_to
        );

        $data['getRecord'] = $getRecord;
        $data['header_title'] = 'Ma liste information';

        return view('teacher.my_notice_board', $data);
    }

    //Espace Parent
    public function myNoticeBoardParent(Request $request)
    {
        $message_to = Auth::user()->user_type;

        $title = trim($request->input('title', ''));
        $notice_date_from = $request->input('notice_date_from', '');
        $notice_date_to = $request->input('notice_date_to', '');

        $getRecord = NoticeBoardModel::getRecordUser(
            $message_to,
            $title,
            $notice_date_from,
            $notice_date_to
        );

        $data['getRecord'] = $getRecord;
        $data['header_title'] = 'Ma liste information';

        return view('parent.my_notice_board', $data);
    }


    //Espace Parent-Elève
    public function myNoticeBoardParentStudent(Request $request)
    {
        $message_to = 3;

        $title = trim($request->input('title', ''));
        $notice_date_from = $request->input('notice_date_from', '');
        $notice_date_to = $request->input('notice_date_to', '');

        $getRecord = NoticeBoardModel::getRecordUser(
            $message_to,
            $title,
            $notice_date_from,
            $notice_date_to
        );

        $data['getRecord'] = $getRecord;
        $data['header_title'] = 'Ma liste information';

        return view('parent.my_student_notice_board', $data);
    }
}