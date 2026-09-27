<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtablissementModel extends Model
{
    use HasFactory;

    protected $table = "etablissement";

    protected $fillable = [
        "nom",
        "logo",
        "url",
        "adresse",
        "is_delete",
        "created_by",
    ];

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getRecord()
    {
        return self::select(
            "etablissement.*",
            "users.name as created_by_name"
        )
            ->leftJoin("users", "users.id", "etablissement.created_by")
            ->where("etablissement.is_delete", "=", 0)
            ->orderBy("etablissement.id", "desc")
            ->paginate(10);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
