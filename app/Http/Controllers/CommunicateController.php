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

        return redirect("admin/communicate/notice_board/list")->with("success", "cette information <<($save->title) >> a bien été enregistré");
    }
}