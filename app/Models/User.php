<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password',];
    protected $hidden = ['password', 'remember_token',];
    protected $casts = ['email_verified_at' => 'datetime',];

    static public function getSingle($id)
    {
        return self::find($id);
    }

    //permet de gerer la personne connecté debut
    public function OnlineUser()
    {
        return Cache::has("OnlineUser" . $this->id);
    }

    public function LastOnline()
    {
        if (!$this->updated_at) {
            return 'Jamais';
        }

        return $this->updated_at->locale('fr')->diffForHumans();
    }

    //Fin


    static public function getAdmin()
    {
        $return = self::select("users.*")
            ->where("user_type", 1)
            ->where("is_delete", 0);

        if (!empty(Request::get("name"))) {
            $return = $return->where("name", "like", "%" . Request::get("name") . "%");
        }

        if (!empty(Request::get("email"))) {
            $return = $return->where("email", "like", "%" . Request::get("email") . "%");
        }

        if (!empty(Request::get("date"))) {
            $return = $return->whereDate("created_at", "=", Request::get("date"));
        }

        return $return
            ->orderBy("id", "desc")
            ->paginate(5);
    }

    static public function getTeacher()
    {
        $return = self::select("users.*")
            ->where("users.user_type", 2)
            ->where("users.is_delete", 0);

        if (!empty(Request::get("name"))) {
            $return = $return->where("users.name", "like", "%" . Request::get("name") . "%");
        }

        if (!empty(Request::get("last_name"))) {
            $return = $return->where("users.last_name", "like", "%" . Request::get("last_name") . "%");
        }

        if (!empty(Request::get("email"))) {
            $return = $return->where("users.email", "like", "%" . Request::get("email") . "%");
        }

        if (!empty(Request::get("gender"))) {
            $return = $return->where("users.gender", "like", "%" . Request::get("gender") . "%");
        }

        if (!empty(Request::get("mobile_number"))) {
            $return = $return->where("users.mobile_number", "like", "%" . Request::get("mobile_number") . "%");
        }

        if (!empty(Request::get("marital_status"))) {
            $return = $return->where("users.marital_status", "like", "%" . Request::get("marital_status") . "%");
        }

        if (!empty(Request::get("address"))) {
            $return = $return->where("users.address", "like", "%" . Request::get("address") . "%");
        }

        if (!empty(Request::get("admission_date"))) {
            $return = $return->whereDate("users.admission_date", "=", Request::get("admission_date"));
        }

        if (!empty(Request::get("created_at"))) {
            $return = $return->whereDate("users.created_at", "=", Request::get("created_at"));
        }

        if (!empty(Request::get("updated_at"))) {
            $return = $return->whereDate("users.updated_at", "=", Request::get("updated_at"));
        }

        if (!empty(Request::get("status"))) {
            $status = Request::get("status") == 100 ? 0 : 1;
            $return = $return->where("users.status", $status);
        }

        return $return
            ->orderBy("id", "desc")
            ->paginate(10);
    }

    static public function getTeacherClass()
    {
        return self::select("users.*")
            ->where("users.user_type", 2)
            ->where("users.is_delete", 0)
            ->orderBy("id", "desc")
            ->get();
    }

    static public function getStudent()
    {
        $return = self::select("users.*", "class.name as class_name", "parent.name as parent_name", "parent.last_name as parent_last_name")
            ->join("users as parent", "parent.id", "=", "users.parent_id", "left")
            ->join("class", "class.id", "=", "users.class_id", "left")
            ->where("users.user_type", 3)
            ->where("users.is_delete", 0);

        if (!empty(Request::get("name"))) {
            $return = $return->where("users.name", "like", "%" . Request::get("name") . "%");
        }

        if (!empty(Request::get("last_name"))) {
            $return = $return->where("users.last_name", "like", "%" . Request::get("last_name") . "%");
        }

        if (!empty(Request::get("email"))) {
            $return = $return->where("users.email", "like", "%" . Request::get("email") . "%");
        }

        if (!empty(Request::get("admission_number"))) {
            $return = $return->where("users.admission_number", "like", "%" . Request::get("admission_number") . "%");
        }

        if (!empty(Request::get("roll_number"))) {
            $return = $return->where("users.roll_number", "like", "%" . Request::get("roll_number") . "%");
        }

        if (!empty(Request::get("class"))) {
            $return = $return->where("class.name", "like", "%" . Request::get("class") . "%");
        }

        if (!empty(Request::get("gender"))) {
            $return = $return->where("users.gender", "like", "%" . Request::get("gender") . "%");
        }

        if (!empty(Request::get("caste"))) {
            $return = $return->where("users.caste", "like", "%" . Request::get("caste") . "%");
        }

        if (!empty(Request::get("religion"))) {
            $return = $return->where("users.religion", "like", "%" . Request::get("religion") . "%");
        }

        if (!empty(Request::get("mobile_number"))) {
            $return = $return->where("users.mobile_number", "like", "%" . Request::get("mobile_number") . "%");
        }

        if (!empty(Request::get("admission_date"))) {
            $return = $return->whereDate("users.admission_date", "=", Request::get("admission_date"));
        }

        if (!empty(Request::get("date_of_birth"))) {
            $return = $return->whereDate("users.date_of_birth", "=", Request::get("date_of_birth"));
        }

        if (!empty(Request::get("created_at"))) {
            $return = $return->whereDate("users.created_at", "=", Request::get("created_at"));
        }

        if (!empty(Request::get("updated_at"))) {
            $return = $return->whereDate("users.updated_at", "=", Request::get("updated_at"));
        }

        if (!empty(Request::get("status"))) {
            $status = Request::get("status") == 100 ? 0 : 1;
            $return = $return->where("users.status", $status);
        }

        return $return
            ->orderBy("id", "desc")
            ->paginate(10);
    }

    static public function getStudentByClassAttendance($class_id)
    {
        return self::select("users.*", "class.name as class_name", "parent.name as parent_name", "parent.last_name as parent_last_name")
            ->leftJoin("users as parent", "parent.id", "=", "users.parent_id")
            ->leftJoin("class", "class.id", "=", "users.class_id")
            ->where("users.user_type", 3)
            ->where("users.is_delete", 0)
            ->where("users.class_id", $class_id)
            ->orderBy("users.name", "asc")
            ->get();
    }

    static public function getSearchStudent()
    {
        if (!empty(Request::get("id")) || !empty(Request::get("name")) || !empty(Request::get("last_name")) || !empty(Request::get("email"))) {
            $return = self::select("users.*", "class.name as class_name", "parent.name as parent_name")
                ->join("users as parent", "parent.id", "=", "users.parent_id", "left")
                ->join("class", "class.id", "=", "users.class_id", "left")
                ->where("users.user_type", 3)
                ->where("users.is_delete", 0);

            if (!empty(Request::get("id"))) {
                $return = $return->where("users.id", Request::get("id"));
            }

            if (!empty(Request::get("name"))) {
                $return = $return->where("users.name", "like", "%" . Request::get("name") . "%");
            }

            if (!empty(Request::get("last_name"))) {
                $return = $return->where("users.last_name", "like", "%" . Request::get("last_name") . "%");
            }

            if (!empty(Request::get("email"))) {
                $return = $return->where("users.email", "like", "%" . Request::get("email") . "%");
            }

            return $return
                ->orderBy("users.id", "desc")
                ->limit(20)
                ->get();
        }

        return collect();
    }

    static public function getUser($user_type)
    {
        return self::select("users.*")
            ->where("user_type", $user_type)
            ->where("is_delete", 0)
            ->get();
    }

    static public function getStudentClass($class_id)
    {
        return self::select("users.id", "users.name", "users.last_name")
            ->where("users.user_type", 3)
            ->where("users.is_delete", 0)
            ->where("users.class_id", $class_id)
            ->orderBy("id", "desc")
            ->get();
    }

    static public function getStudenTeacher($teacher_id)
    {
        return self::select("users.*", "class.name as class_name")
            ->join("class", "class.id", "=", "users.class_id")
            ->join("assign_class_subject_teacher", "assign_class_subject_teacher.class_id", "=", "class.id")
            ->where("assign_class_subject_teacher.teacher_id", $teacher_id)
            ->where("assign_class_subject_teacher.status", 0)
            ->where("assign_class_subject_teacher.is_delete", 0)
            ->where("users.user_type", 3)
            ->where("users.is_delete", 0)
            ->groupBy("users.id", "class.name")
            ->orderBy("users.id", "desc")
            ->paginate(10);
    }

    static public function getParent()
    {
        $return = self::select("users.*")
            ->where("user_type", 4)
            ->where("is_delete", 0);

        if (!empty(Request::get("name"))) {
            $return = $return->where("users.name", "like", "%" . Request::get("name") . "%");
        }

        if (!empty(Request::get("last_name"))) {
            $return = $return->where("users.last_name", "like", "%" . Request::get("last_name") . "%");
        }

        if (!empty(Request::get("email"))) {
            $return = $return->where("users.email", "like", "%" . Request::get("email") . "%");
        }

        if (!empty(Request::get("gender"))) {
            $return = $return->where("users.gender", "like", "%" . Request::get("gender") . "%");
        }

        if (!empty(Request::get("occupation"))) {
            $return = $return->where("users.occupation", "like", "%" . Request::get("occupation") . "%");
        }

        if (!empty(Request::get("mobile_number"))) {
            $return = $return->where("users.mobile_number", "like", "%" . Request::get("mobile_number") . "%");
        }

        if (!empty(Request::get("address"))) {
            $return = $return->where("users.address", "like", "%" . Request::get("address") . "%");
        }

        if (!empty(Request::get("created_at"))) {
            $return = $return->whereDate("users.created_at", "=", Request::get("created_at"));
        }

        if (!empty(Request::get("updated_at"))) {
            $return = $return->whereDate("users.updated_at", "=", Request::get("updated_at"));
        }

        if (!empty(Request::get("status"))) {
            $status = Request::get("status") == 100 ? 0 : 1;
            $return = $return->where("users.status", $status);
        }

        return $return
            ->orderBy("id", "desc")
            ->paginate(5);
    }

    static public function getMyStudent($parent_id)
    {
        return self::select("users.*", "class.name as class_name", "parent.name as parent_name")
            ->join("users as parent", "parent.id", "=", "users.parent_id")
            ->join("class", "class.id", "=", "users.class_id", "left")
            ->where("users.user_type", 3)
            ->where("users.parent_id", $parent_id)
            ->where("users.is_delete", 0)
            ->orderBy("users.id", "desc")
            ->get();
    }

    static public function getEmailSingle($email)
    {
        return self::where("email", $email)->first();
    }

    static public function getTokenSingle($remember_token)
    {
        return self::where("remember_token", $remember_token)->first();
    }

    static public function getAttendance($class_id, $subject_id, $attendance_date, $student_id)
    {
        return StudentAttendanceModel::CheckAlreadyAttendance($class_id, $subject_id, $attendance_date, $student_id);
    }

    public function getProfile()
    {
        if (!empty($this->profile_pic) && file_exists(public_path("upload/profile/" . $this->profile_pic))) {
            return url("upload/profile/" . $this->profile_pic);
        }

        return asset("assets1/img/default-avatar.png");
    }


    public function classSubjects()
    {
        return $this->hasMany(ClassSubjectTeacherModel::class, "teacher_id");
    }

    static public function getStudentFees()
    {
        $return = self::select("users.*", "class.name as class_name", "class.amount as amount")
            ->leftJoin("class", "class.id", "=", "users.class_id")
            ->where("users.user_type", 3)
            ->where("users.is_delete", 0);

        if (!empty(Request::get("class_id"))) {
            $return = $return->where("users.class_id", Request::get("class_id"));
        }

        if (!empty(Request::get("student_id"))) {
            $return = $return->where("users.id", Request::get("student_id"));
        }

        if (!empty(Request::get("name"))) {
            $return = $return->where("users.name", "like", "%" . Request::get("name") . "%");
        }

        if (!empty(Request::get("last_name"))) {
            $return = $return->where("users.last_name", "like", "%" . Request::get("last_name") . "%");
        }

        return $return
            ->orderBy("users.name", "asc")
            ->paginate(10);
    }

    static public function getSingleStudentFees($student_id)
    {
        return self::select("users.*", "class.name as class_name", "class.amount as amount")
            ->leftJoin("class", "class.id", "=", "users.class_id")
            ->where("users.id", $student_id)
            ->where("users.user_type", 3)
            ->where("users.is_delete", 0)
            ->first();
    }

    static public function getStudentPayments($student_id)
    {
        return DB::table("student_add_fees")
            ->where("student_id", $student_id)
            ->orderByDesc("id")
            ->get();
    }

    static public function getStudentPaidAmount($student_id)
    {
        return (float) DB::table("student_add_fees")
            ->where("student_id", $student_id)
            ->sum("paid_amount");
    }

    static public function getStudentTotalAmount($student_id)
    {
        $student = self::getSingleStudentFees($student_id);

        if (!$student) {
            return 0;
        }

        return (float) $student->amount;
    }

    static public function getStudentRemainingAmount($student_id)
    {
        $totalAmount = self::getStudentTotalAmount($student_id);
        $paidAmount = self::getStudentPaidAmount($student_id);

        return max(0, $totalAmount - $paidAmount);
    }

    static public function getPaidAmountsByStudents($studentIds)
    {
        if (empty($studentIds)) {
            return [];
        }

        $payments = DB::table("student_add_fees")
            ->select("student_id", DB::raw("SUM(paid_amount) as total_paid"))
            ->whereIn("student_id", $studentIds)
            ->groupBy("student_id")
            ->get();

        $result = [];

        foreach ($payments as $payment) {
            $result[$payment->student_id] = (float) $payment->total_paid;
        }

        return $result;
    }

    static public function getRemainingAmountsByStudents($studentIds)
    {
        if (empty($studentIds)) {
            return [];
        }

        $students = self::select("users.id", "class.amount as total_amount")
            ->leftJoin("class", "class.id", "=", "users.class_id")
            ->whereIn("users.id", $studentIds)
            ->get();

        $paidAmounts = self::getPaidAmountsByStudents($studentIds);

        $result = [];

        foreach ($students as $student) {
            $totalAmount = (float) $student->total_amount;

            $paidAmount = isset($paidAmounts[$student->id])
                ? (float) $paidAmounts[$student->id]
                : 0;

            $result[$student->id] = max(0, $totalAmount - $paidAmount);
        }

        return $result;
    }

    static public function getLastPaymentByStudent($student_id)
    {
        return DB::table("student_add_fees")
            ->where("student_id", $student_id)
            ->orderByDesc("id")
            ->first();
    }

    static public function getRemainingAmountFromLastPayment($student_id)
    {
        $payment = self::getLastPaymentByStudent($student_id);

        if (!$payment) {
            return self::getStudentRemainingAmount($student_id);
        }

        return max(0, (float) $payment->remaning_amount);
    }

    static public function getRemainingAmountsFromLastPayments($studentIds)
    {
        if (empty($studentIds)) {
            return [];
        }

        $payments = DB::table("student_add_fees")
            ->select("student_id", "remaning_amount")
            ->whereIn("student_id", $studentIds)
            ->whereIn("id", function ($query) use ($studentIds) {
                $query->select(DB::raw("MAX(id)"))
                    ->from("student_add_fees")
                    ->whereIn("student_id", $studentIds)
                    ->groupBy("student_id");
            })
            ->get();

        $result = [];

        foreach ($payments as $payment) {
            $result[$payment->student_id] = max(0, (float) $payment->remaning_amount);
        }

        return $result;
    }

    static public function getPaymentById($id)
    {
        return DB::table("student_add_fees")
            ->where("id", $id)
            ->first();
    }

    static public function getPayment($id)
    {
        return self::getPaymentById($id);
    }

    static public function getStudentPaymentTotalWithoutCurrent($student_id, $payment_id)
    {
        return (float) DB::table("student_add_fees")
            ->where("student_id", $student_id)
            ->where("id", "!=", $payment_id)
            ->sum("paid_amount");
    }

    static public function getPaidAmountWithoutPayment($studentId, $paymentId)
    {
        return (float) DB::table("student_add_fees")
            ->where("student_id", $studentId)
            ->where("id", "!=", $paymentId)
            ->sum("paid_amount");
    }

    static public function getClass($class_id)
    {
        return DB::table("class")
            ->where("id", $class_id)
            ->first();
    }

    static public function getClassById($classId)
    {
        return DB::table("class")
            ->where("id", $classId)
            ->first();
    }

    static public function getNextPaymentReference($student_id)
    {
        $lastPayment = self::getLastPaymentByStudent($student_id);

        $numero = 1;

        if ($lastPayment && !empty($lastPayment->ref_payement)) {
            if (preg_match("/^@#MAJ#(\d+)#$/", $lastPayment->ref_payement, $matches)) {
                $numero = ((int) $matches[1]) + 1;
            }
        }

        do {
            $reference = "@#MAJ#" . $numero . "#";
            $numero++;
        } while (DB::table("student_add_fees")->where("ref_payement", $reference)->exists());

        return $reference;
    }

    static public function insertStudentPayment($student_id, $class_id, $total_amount, $paid_amount, $remaining_amount, $payment_type, $reference, $observation, $payment_date)
    {
        return DB::table("student_add_fees")
            ->insert([
                "student_id" => $student_id,
                "class_id" => $class_id,
                "total_amount" => $total_amount,
                "paid_amount" => $paid_amount,
                "remaning_amount" => $remaining_amount,
                "payment_type" => $payment_type,
                "ref_payement" => $reference,
                "observation" => $observation,
                "created_at" => $payment_date,
                "updated_at" => now()
            ]);
    }

    static public function updateStudentPayment($id, array $data)
    {
        return DB::table("student_add_fees")
            ->where("id", $id)
            ->update($data);
    }

    static public function getStudentPaymentReceiptData($id)
    {
        $payment = self::getPaymentById($id);

        if (!$payment) {
            return null;
        }

        $student = self::find($payment->student_id);

        if (!$student) {
            return null;
        }

        $totalPaid = self::getStudentPaidAmount($payment->student_id);
        $totalAmount = (float) $payment->total_amount;
        $remainingAmount = max(0, $totalAmount - $totalPaid);

        return [
            "payment" => $payment,
            "student" => $student,
            "totalAmount" => $totalAmount,
            "totalPaid" => $totalPaid,
            "remainingAmount" => $remainingAmount
        ];
    }

    //RAPPORT AVEC LES RESUMES DU DASHBOARD 
    //permet de definir le nombre total des utilisateur
    static public function getTotalUser($user_type)
    {
        return self::select("users.id")
            ->where("user_type", "=", $user_type)
            ->where("is_delete", "=", 0)
            ->count();
    }

    // permet juste d'afficher le montant total payer par les élèves pendant le jour en cour
    static public function getTotalTodayFees()
    {
        return (float) DB::table("student_add_fees")
            ->whereDate("created_at", today())
            ->sum("paid_amount");
    }
    //permet de definir
    static public function getTotalSchoolFees()
    {
        return (float) self::leftJoin("class", "class.id", "=", "users.class_id")
            ->where("users.user_type", 3)
            ->where("users.is_delete", 0)
            ->sum("class.amount");
    }

    static public function getTotalPaidSchoolFees()
    {
        return (float) DB::table("student_add_fees")
            ->join("users", "users.id", "=", "student_add_fees.student_id")
            ->where("users.user_type", 3)
            ->where("users.is_delete", 0)
            ->sum("student_add_fees.paid_amount");
    }

    static public function getTotalRemainingSchoolFees()
    {
        $total = self::getTotalSchoolFees();
        $paid = self::getTotalPaidSchoolFees();

        return max(0, $total - $paid);
    }

    static public function getSchoolFeesPercentage()
    {
        $total = self::getTotalSchoolFees();
        $paid = self::getTotalPaidSchoolFees();

        if ($total <= 0) {
            return 0;
        }

        return min(100, round(($paid / $total) * 100, 2));
    }

    static public function getRemainingSchoolFeesPercentage()
    {
        $total = self::getTotalSchoolFees();
        $paid = self::getTotalPaidSchoolFees();

        if ($total <= 0) {
            return 0;
        }

        return min(100, round((($total - $paid) / $total) * 100, 2));
    }

    //partie qui permet de gerer les eleves de la classe de maniere direct
    static public function getStudentByClass($class_id)
    {
        return self::select(
            "users.*",
            "class.name as class_name",
            "parent.name as parent_name",
            "parent.last_name as parent_last_name"
        )
            ->leftJoin("users as parent", "parent.id", "=", "users.parent_id")
            ->leftJoin("class", "class.id", "=", "users.class_id")
            ->where("users.user_type", 3)
            ->where("users.is_delete", 0)
            ->where("users.class_id", $class_id)
            ->orderBy("users.name", "asc")
            ->paginate(20);
    }
}