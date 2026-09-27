<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeesCollectionController extends Controller
{

    //ESPACE ADMINISTRATEUR
    public function CollectFees(Request $request)
    {
        $data["getClass"] = ClassModel::getClass();
        $data["header_title"] = "Liste des scolaritées";

        if ($request->filled("class_id") || $request->filled("student_id") || $request->filled("name") || $request->filled("last_name")) {
            $data["getRecord"] = User::getStudentFees();
        } else {
            $data["getRecord"] = User::where("id", 0)->paginate(10);
        }

        $studentIds = $data["getRecord"]->pluck("id")->toArray();
        $data["paidAmounts"] = User::getPaidAmountsByStudents($studentIds);
        $data["remaning_amount"] = User::getRemainingAmountsFromLastPayments($studentIds);
        return view("admin.fees_collection.collect_fees", $data);
    }

    public function getStudentsByClass(Request $request)
    {
        $students = User::getStudentClass($request->class_id);
        return response()->json($students);
    }

    public function CollectFeesAdd($student_id, Request $request)
    {
        $data["getRecord"] = User::getSingleStudentFees($student_id);

        if (!$data["getRecord"]) {
            return redirect(url("admin/fees_collection/collect_fees"))
                ->with("error", "Élève introuvable.");
        }

        $data["payments"] = User::getStudentPayments($student_id);
        $data["paidAmount"] = User::getStudentPaidAmount($student_id);
        $data["totalAmount"] = User::getStudentTotalAmount($student_id);
        $data["remainingAmount"] = User::getStudentRemainingAmount($student_id);
        $data["return_url"] = $request->get("return_url", url("admin/fees_collection/collect_fees"));
        $data["header_title"] = "Faire un versement";
        return view("admin.fees_collection.add_collect_fees", $data);
    }

    public function CollectFeesInsert($student_id, Request $request)
    {
        $request->validate([
            "student_id" => "required|integer",
            "class_id" => "required|integer",
            "amount" => "required|numeric|min:1",
            "payment_date" => "required|date",
            "payment_method" => "required|string|max:50",
            "observation" => "nullable|string"
        ]);

        $studentId = (int) $student_id;
        $classId = (int) $request->class_id;
        $amount = (float) $request->amount;
        $student = User::getSingleStudentFees($studentId);

        if (!$student) {
            return back()
                ->withInput()
                ->with("error", "Élève introuvable.");
        }

        $class = User::getClassById($classId);

        if (!$class) {
            return back()
                ->withInput()
                ->with("error", "Classe introuvable.");
        }

        $totalAmount = (float) $class->amount;
        $paidAmount = User::getStudentPaidAmount($studentId);
        $remainingAmount = max(0, $totalAmount - $paidAmount);

        if ($remainingAmount <= 0) {
            return back()
                ->withInput()
                ->with("error", "La scolarité de cet élève est déjà entièrement payée.");
        }

        if ($amount > $remainingAmount) {
            return back()
                ->withInput()
                ->with("error", "Le montant du versement dépasse le reste à payer.");
        }

        $newPaidAmount = $paidAmount + $amount;
        $newRemainingAmount = max(0, $totalAmount - $newPaidAmount);
        $reference = User::getNextPaymentReference($studentId);

        User::insertStudentPayment(
            $studentId,
            $classId,
            $totalAmount,
            $amount,
            $newRemainingAmount,
            $request->payment_method,
            $reference,
            $request->observation,
            $request->payment_date
        );

        return redirect()
            ->back()
            ->with("success", "Versement enregistré avec succès. Référence : " . $reference);
    }

    public function CollectFeesEdit($id)
    {
        $payment = User::getPaymentById($id);

        if (!$payment) {
            return redirect(url("admin/fees_collection/collect_fees"))
                ->with("error", "Versement introuvable.");
        }

        $student = User::getSingleStudentFees($payment->student_id);

        if (!$student) {
            return redirect(url("admin/fees_collection/collect_fees"))
                ->with("error", "Élève introuvable.");
        }

        $class = User::getClassById($payment->class_id);

        if (!$class) {
            return redirect(url("admin/fees_collection/collect_fees"))
                ->with("error", "Classe introuvable.");
        }

        $totalPaidWithoutCurrent = User::getPaidAmountWithoutPayment(
            $payment->student_id,
            $payment->id
        );

        $totalAmount = (float) $class->amount;
        $maximumAmount = max(0, $totalAmount - $totalPaidWithoutCurrent);
        $data["payment"] = $payment;
        $data["student"] = $student;
        $data["class"] = $class;
        $data["totalAmount"] = $totalAmount;
        $data["totalPaidWithoutCurrent"] = $totalPaidWithoutCurrent;
        $data["maximumAmount"] = $maximumAmount;
        $data["header_title"] = "Modifier le versement";

        return view("admin.fees_collection.edit_collect_fees", $data);
    }

    public function CollectFeesUpdate($id, Request $request)
    {
        $request->validate([
            "student_id" => "required|integer",
            "class_id" => "required|integer",
            "amount" => "required|numeric|min:1",
            "payment_date" => "required|date",
            "payment_method" => "required|string|max:50",
            "observation" => "nullable|string"
        ]);

        $payment = User::getPaymentById($id);

        if (!$payment) {
            return back()
                ->withInput()
                ->with("error", "Versement introuvable.");
        }

        $studentId = (int) $request->student_id;
        $classId = (int) $request->class_id;
        $newAmount = (float) $request->amount;
        $student = User::getSingleStudentFees($studentId);

        if (!$student) {
            return back()
                ->withInput()
                ->with("error", "Élève introuvable.");
        }

        $class = User::getClassById($classId);

        if (!$class) {
            return back()
                ->withInput()
                ->with("error", "Classe introuvable.");
        }

        $totalAmount = (float) $class->amount;
        $paidWithoutCurrent = User::getPaidAmountWithoutPayment($studentId, $id);
        $remainingForCurrent = max(0, $totalAmount - $paidWithoutCurrent);

        if ($newAmount > $remainingForCurrent) {
            return back()
                ->withInput()
                ->with("error", "Le nouveau montant dépasse le reste disponible.");
        }

        $newTotalPaid = $paidWithoutCurrent + $newAmount;
        $newRemaining = max(0, $totalAmount - $newTotalPaid);

        User::updateStudentPayment(
            $id,
            [
                "student_id" => $studentId,
                "class_id" => $classId,
                "total_amount" => $totalAmount,
                "paid_amount" => $newAmount,
                "remaning_amount" => $newRemaining,
                "payment_type" => $request->payment_method,
                "observation" => $request->observation,
                "created_at" => $request->payment_date,
                "updated_at" => now()
            ]
        );
        return redirect(url("admin/fees_collection/collect_fees/add_fees/" . $studentId))->with("success", "Versement modifié avec succès.");
    }

    public function PaymentReceipt($id)
    {
        $data = User::getStudentPaymentReceiptData($id);

        if (!$data) {
            return redirect(url("admin/fees_collection/collect_fees"))->with("error", "Paiement ou élève introuvable.");
        }
        return view("admin.fees_collection.payment_receipt", $data);
    }

    //ESPACE ELEVE
    public function MyCollectFeesStudent()
    {
        $studentId = Auth::user()->id;
        $getRecord = User::getSingleStudentFees($studentId);

        if (!$getRecord) {
            return redirect()
                ->back()
                ->with("error", "Élève introuvable.");
        }

        $payments = User::getStudentPayments($studentId);
        $paidAmount = User::getStudentPaidAmount($studentId);
        $totalAmount = User::getStudentTotalAmount($studentId);
        $remainingAmount = User::getStudentRemainingAmount($studentId);
        $return_url = url()->previous();

        $header_title = "Ma scolarité";
        return view("student.collect_fees", compact("getRecord", "payments", "paidAmount", "remainingAmount", "return_url", "header_title"));
    }

    //ESPACE PARENT
    public function MyCollectFeesParent($student_id)
    {
        $getRecord = User::getSingleStudentFees($student_id);

        if (!$getRecord) {
            return redirect()
                ->back()
                ->with("error", "Élève introuvable.");
        }

        $payments = User::getStudentPayments($student_id);
        $paidAmount = User::getStudentPaidAmount($student_id);
        $totalAmount = User::getStudentTotalAmount($student_id);
        $remainingAmount = User::getStudentRemainingAmount($student_id);
        $return_url = url("parent/my_student");

        $header_title = "Scolarité de l'élève";
        return view("student.collect_fees", compact("getRecord", "payments", "paidAmount", "remainingAmount", "return_url", "header_title"));
    }
}