<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class NoticeBoardModel extends Model
{
    use HasFactory;
    protected $table = "notice_board";

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getRecord()
    {
        $return = self::select("notice_board.*", "users.name as created_by_name")
            ->join("users", "users.id", "=", "notice_board.created_by");

        $title = request()->get("title");
        $notice_date_to = request()->get("notice_date_to");
        $notice_date_from = request()->get("notice_date_from");
        $publish_date_to = request()->get("publish_date_to");
        $publish_date_from = request()->get("publish_date_from");
        $message_to = request()->get("message_to");

        if (!empty($title)) {
            $return = $return->where("notice_board.title", "like", "%" . trim($title) . "%");
        }

        if (!empty($notice_date_from)) {
            $return = $return->whereDate("notice_board.notice_date", ">=", $notice_date_from);
        }

        if (!empty($notice_date_to)) {
            $return = $return->whereDate("notice_board.notice_date", "<=", $notice_date_to);
        }

        if (!empty($publish_date_from)) {
            $return = $return->whereDate("notice_board.publish_date", ">=", $publish_date_from);
        }

        if (!empty($publish_date_to)) {
            $return = $return->whereDate("notice_board.publish_date", "<=", $publish_date_to);
        }

        if (!empty($message_to)) {
            $return = $return->whereHas("getMessage", function ($query) use ($message_to) {
                $query->where("message_to", $message_to);
            });
        }

        $return = $return->orderBy("notice_board.id", "desc")
            ->paginate(10);

        return $return;
    }

    static public function getRecordUser($message_to, $title = '', $notice_date_from = '', $notice_date_to = '')
    {
        $return = NoticeBoardModel::query();

        $return->whereHas("getMessage", function ($query) use ($message_to) {
            $query->where("message_to", $message_to);
        });

        if (!empty($title)) {
            $return->where(
                "notice_board.title",
                "like",
                "%" . trim($title) . "%"
            );
        }

        if (!empty($notice_date_from) && !empty($notice_date_to)) {
            $return->whereDate(
                "notice_board.notice_date",
                ">=",
                $notice_date_from
            );

            $return->whereDate(
                "notice_board.notice_date",
                "<=",
                $notice_date_to
            );
        }

        return $return
            ->orderBy("notice_board.notice_date", "desc")
            ->paginate(10)
            ->withQueryString();
    }

    public  function getMessage()
    {
        return $this->hasMany(NoticeBoardMessageModel::class, "notice_board_id");
    }

    public  function NoticeBoardMessageSingle($notice_board_id, $message)
    {
        return NoticeBoardMessageModel::where("notice_board_id", "=", $notice_board_id)->where("message_to", "=", $message)->first();
    }
}