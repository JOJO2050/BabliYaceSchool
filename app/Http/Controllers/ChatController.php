<?php

namespace App\Http\Controllers;

use App\Models\chatModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ChatController extends Controller
{
    public function chatSpace(Request $request)
    {
        $data["header_title"] = "Mon espace de chat";
        $sender_id = Auth::user()->id;
        if (!empty($request->receiver_id)) {
            $receiver_id = base64_decode($request->receiver_id);
            if ($receiver_id == $sender_id) {
                return redirect()->back()->with("error", "Une erreur est survenue, veuillez réessayer plus tard.");
            }
            chatModel::updateCount($sender_id, $receiver_id);
            $data["receiver_id"] = $receiver_id;
            $data["getReceiver"] = User::getSingle($receiver_id);
            $data["getChat"] = chatModel::getChat($receiver_id, $sender_id);
        } else {
            $data["receiver_id"] = "";
        }
        $data["getChatUser"] = chatModel::getChatUser($sender_id);
        return view("chat.list", $data);
    }

    public function SubmitMessage(Request $request)
    {
        $chat = new chatModel;
        $chat->sender_id = Auth::user()->id;
        $chat->receiver_id = $request->receiver_id;
        $chat->message = $request->message;
        $chat->created_date = time();

        if (!empty($request->file("file_name"))) {
            $ext = $request->file("file_name")->getClientOriginalExtension();
            $file = $request->file("file_name");
            $randomStr = date("Ymdhis") . Str::random(20);
            $filename = strtolower($randomStr) . "." . $ext;
            $file->move("upload/chat/", $filename);
            $chat->file = $filename;
        }

        $chat->save();

        $getChat = chatModel::where("id", "=", $chat->id)->get();
        $getChatUser = chatModel::getChatUser(Auth::user()->id);

        return response()->json([
            "status" => true,
            "success" => view("chat._single", ["getChat" => $getChat])->render(),
            "count" => chatModel::getAllChatUserCount(),
            "chat_users" => view("chat._user", [
                "getChatUser" => $getChatUser,
                "receiver_id" => $request->receiver_id
            ])->render()
        ]);
    }

    public function getChatWindows(Request $request)
    {
        $receiver_id = $request->receiver_id;
        $sender_id = Auth::user()->id;

        chatModel::updateCount($sender_id, $receiver_id);

        $getReceiver = User::getSingle($receiver_id);
        $getChat = chatModel::getChat($receiver_id, $sender_id);
        $getChatUser = chatModel::getChatUser($sender_id);

        return response()->json([
            "receiver_id" => base64_encode($receiver_id),
            "status" => true,
            "messagecount" => 0,
            "count" => chatModel::getAllChatUserCount(),
            "success" => view("chat._message", [
                "getReceiver" => $getReceiver,
                "getChat" => $getChat
            ])->render(),
            "chat_users" => view("chat._user", [
                "getChatUser" => $getChatUser,
                "receiver_id" => $receiver_id
            ])->render()
        ]);
    }

    public function getChatSearchUser(Request $request)
    {
        $receiver_id = $request->receiver_id;
        $sender_id = Auth::user()->id;
        $getChatUser = chatModel::getChatUser($sender_id);

        return response()->json([
            "status" => true,
            "success" => view("chat._user", [
                "getChatUser" => $getChatUser,
                "receiver_id" => $receiver_id
            ])->render()
        ]);
    }

    public function getNewChatMessages(Request $request)
    {
        $sender_id = Auth::user()->id;
        $receiver_id = $request->receiver_id;

        if (!empty($receiver_id)) {
            chatModel::updateCount($sender_id, $receiver_id);
            $getChat = chatModel::getChat($receiver_id, $sender_id);
        } else {
            $getChat = collect();
        }

        $getChatUser = chatModel::getChatUser($sender_id);

        return response()->json([
            "status" => true,
            "success" => view("chat._chat", [
                "getChat" => $getChat
            ])->render(),
            "chat_users" => view("chat._user", [
                "getChatUser" => $getChatUser,
                "receiver_id" => $receiver_id
            ])->render(),
            "count" => chatModel::getAllChatUserCount()
        ]);
    }

    public function chatTyping(Request $request)
    {
        $sender_id = Auth::user()->id;
        $receiver_id = $request->receiver_id;

        $key = "chat_typing_" . $sender_id . "_" . $receiver_id;

        cache()->put($key, true, now()->addSeconds(2));

        return response()->json(["status" => true]);
    }

    public function getChatTyping(Request $request)
    {
        $sender_id = Auth::user()->id;
        $receiver_id = $request->receiver_id;

        $key = "chat_typing_" . $receiver_id . "_" . $sender_id;

        return response()->json([
            "status" => true,
            "typing" => cache()->has($key)
        ]);
    }

    public function getChatUserStatus(Request $request)
    {
        $user = User::find($request->receiver_id);

        if (!$user) {
            return response()->json(["status" => false]);
        }

        return response()->json([
            "status" => true,
            "is_online" => $user->OnlineUser(),
            "last_seen" => $user->updated_at
                ? \Carbon\Carbon::parse($user->updated_at)->format('d/m/Y H:i')
                : null
        ]);
    }

    public function getChatUsersStatus()
    {
        $sender_id = Auth::id();
        $users = User::where("id", "!=", $sender_id)->get();
        $statuses = [];

        foreach ($users as $user) {
            $statuses[$user->id] = [
                "is_online" => $user->OnlineUser(),
                "last_seen" => $user->updated_at
                    ? \Carbon\Carbon::parse($user->updated_at)->format('d/m/Y H:i')
                    : null
            ];
        }

        return response()->json([
            "status" => true,
            "users" => $statuses
        ]);
    }
}