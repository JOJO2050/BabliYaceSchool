<?php



namespace App\Http\Controllers;

use App\Mail\SenEmailUserMail;
use App\Models\NoticeBoardMessageModel;
use App\Models\NoticeBoardModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CommunicateController extends Controller
{
    //Espace Administrateur


    //Envoie de mail debut

    public function SendEmail()
    {
        $data["header_title"] = "Envoyer un email";
        return view('admin.communicate.send_email', $data);
    }
    public function SearchUser(Request $request)
    {
        $search = trim($request->input('search', ''));
        $userType = $request->input('user_type');

        if ($search === '' || empty($userType)) {
            return response()->json([]);
        }

        $userType = (int) $userType;

        if (!in_array($userType, [2, 3, 4])) {
            return response()->json([]);
        }

        $users = User::query()
            ->where('user_type', $userType)
            ->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%');
            })
            ->whereNotNull('email')
            ->where('email', '!=', '')
            ->orderBy('name', 'asc')
            ->limit(10)
            ->get();

        $results = $users->map(function ($user) {
            return [
                'id' => $user->id,
                'text' => $user->name . (!empty($user->email) ? ' - ' . $user->email : ''),
            ];
        });

        return response()->json($results);
    }
    public function SendEmailUser(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required',
            'user_id' => 'required|exists:users,id',
            'message_to' => 'required|in:2,3,4',
        ]);

        $user = User::find($request->user_id);

        if (!$user) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Utilisateur introuvable.');
        }

        if (empty($user->email)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Cet utilisateur ne possède pas d’adresse email.');
        }

        if ((int) $user->user_type !== (int) $request->message_to) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Le type de l’utilisateur sélectionné ne correspond pas au destinataire choisi.');
        }

        $user->send_message = $request->message;
        $user->send_subject = $request->subject;

        Mail::to($user->email)->send(
            new SenEmailUserMail($user)
        );

        return redirect()->back()->with(
            'success',
            'Votre email a bien été envoyé à ' . $user->name . '.'
        );
    }

    public function NoticeBoard(Request $request)
    {
        $data['getRecord'] = NoticeBoardModel::getRecord();
        $data['header_title'] = "Liste des informations";
        return view('admin.communicate.notice_board.list', $data);
    }

    //Envoie de mail fin

    //Envoie d'information général debut

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

    //Envoie d'information général fin


    //Espace Elève gestion d'information générale debut

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
