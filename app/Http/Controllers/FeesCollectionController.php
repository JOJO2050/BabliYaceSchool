<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeesCollectionController extends Controller
{
    public function CollectFees(Request $request)
    {
        $data["getClass"] = ClassModel::getClass();
        $data["header_title"] = "Liste des scolaritées";

        if (
            $request->filled('class_id') ||
            $request->filled('student_id') ||
            $request->filled('name') ||
            $request->filled('last_name')
        ) {
            $data["getRecord"] = User::getStudentFees();
        } else {
            $data["getRecord"] = User::where('id', 0)->paginate(10);
        }

        $studentIds = $data["getRecord"]
            ->pluck('id')
            ->toArray();

        $data["paidAmounts"] = [];
        $data["remaning_amount"] = [];

        if (!empty($studentIds)) {

            $paidAmounts = DB::table('student_add_fees')
                ->select(
                    'student_id',
                    DB::raw('SUM(paid_amount) as total_paid')
                )
                ->whereIn('student_id', $studentIds)
                ->groupBy('student_id')
                ->get();

            foreach ($paidAmounts as $paid) {
                $data["paidAmounts"][$paid->student_id] = (float) $paid->total_paid;
            }

            $lastPayments = DB::table('student_add_fees')
                ->select(
                    'student_id',
                    'remaning_amount'
                )
                ->whereIn('student_id', $studentIds)
                ->whereIn('id', function ($query) use ($studentIds) {
                    $query->select(DB::raw('MAX(id)'))
                        ->from('student_add_fees')
                        ->whereIn('student_id', $studentIds)
                        ->groupBy('student_id');
                })
                ->get();

            foreach ($lastPayments as $payment) {
                $data["remaning_amount"][$payment->student_id] =
                    (float) $payment->remaning_amount;
            }
        }

        return view(
            "admin.fees_collection.collect_fees",
            $data
        );
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
            return redirect(
                url('admin/fees_collection/collect_fees')
            )->with('error', 'Élève introuvable.');
        }

        $data["payments"] = DB::table('student_add_fees')
            ->where('student_id', $student_id)
            ->orderByDesc('id')
            ->get();

        $data["paidAmount"] = (float) DB::table('student_add_fees')
            ->where('student_id', $student_id)
            ->sum('paid_amount');

        $data["totalAmount"] = (float) $data["getRecord"]->amount;

        $data["remainingAmount"] = max(
            0,
            $data["totalAmount"] - $data["paidAmount"]
        );

        $data["return_url"] = $request->get(
            'return_url',
            url('admin/fees_collection/collect_fees')
        );

        $data["header_title"] = "Faire un versement";

        return view(
            "admin.fees_collection.add_collect_fees",
            $data
        );
    }


    public function CollectFeesInsert($student_id, Request $request)
    {
        $request->validate([
            'student_id' => 'required|integer',
            'class_id' => 'required|integer',
            'amount' => 'required|numeric|min:1',
            'payment_date' => 'required|date',
            'payment_method' => 'required|string|max:50',
            'observation' => 'nullable|string'
        ]);

        $studentId = (int) $student_id;
        $classId = (int) $request->class_id;
        $amount = (float) $request->amount;

        $student = DB::table('users')
            ->where('id', $studentId)
            ->first();

        if (!$student) {
            return back()
                ->withInput()
                ->with('error', 'Élève introuvable.');
        }

        $class = DB::table('class')
            ->where('id', $classId)
            ->first();

        if (!$class) {
            return back()
                ->withInput()
                ->with('error', 'Classe introuvable.');
        }

        $totalAmount = (float) $class->amount;

        $paidAmount = (float) DB::table('student_add_fees')
            ->where('student_id', $studentId)
            ->sum('paid_amount');

        $remainingAmount = $totalAmount - $paidAmount;

        if ($remainingAmount <= 0) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'La scolarité de cet élève est déjà entièrement payée.'
                );
        }

        if ($amount > $remainingAmount) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Le montant du versement dépasse le reste à payer.'
                );
        }

        $newPaidAmount = $paidAmount + $amount;
        $newRemainingAmount = $totalAmount - $newPaidAmount;

        $lastPayment = DB::table('student_add_fees')
            ->where('student_id', $studentId)
            ->orderByDesc('id')
            ->first();

        $numero = 1;

        if ($lastPayment && !empty($lastPayment->ref_payement)) {
            if (
                preg_match(
                    '/^@#MAJ#(\d+)#$/',
                    $lastPayment->ref_payement,
                    $matches
                )
            ) {
                $numero = ((int) $matches[1]) + 1;
            }
        }

        do {
            $reference = '@#MAJ#' . $numero . '#';
            $numero++;
        } while (
            DB::table('student_add_fees')
            ->where('ref_payement', $reference)
            ->exists()
        );

        DB::table('student_add_fees')->insert([
            'student_id' => $studentId,
            'class_id' => $classId,
            'total_amount' => $totalAmount,
            'paid_amount' => $amount,
            'remaning_amount' => $newRemainingAmount,
            'payment_type' => $request->payment_method,
            'ref_payement' => $reference,
            'observation' => $request->observation,
            'created_at' => $request->payment_date,
            'updated_at' => now()
        ]);

        return redirect()
            ->back()
            ->with(
                'success',
                'Versement enregistré avec succès. Référence : ' . $reference
            );
    }

    public function CollectFeesEdit($id)
    {
        $payment = DB::table('student_add_fees')
            ->where('id', $id)
            ->first();

        if (!$payment) {
            return redirect(
                url('admin/fees_collection/collect_fees')
            )->with('error', 'Versement introuvable.');
        }

        $student = User::getSingleStudentFees($payment->student_id);

        if (!$student) {
            return redirect(
                url('admin/fees_collection/collect_fees')
            )->with('error', 'Élève introuvable.');
        }

        $class = DB::table('class')
            ->where('id', $payment->class_id)
            ->first();

        if (!$class) {
            return redirect(
                url('admin/fees_collection/collect_fees')
            )->with('error', 'Classe introuvable.');
        }

        $totalPaidWithoutCurrent = (float) DB::table('student_add_fees')
            ->where('student_id', $payment->student_id)
            ->where('id', '!=', $payment->id)
            ->sum('paid_amount');

        $totalAmount = (float) $class->amount;

        $maximumAmount = $totalAmount - $totalPaidWithoutCurrent;

        $data["payment"] = $payment;
        $data["student"] = $student;
        $data["class"] = $class;
        $data["totalAmount"] = $totalAmount;
        $data["totalPaidWithoutCurrent"] = $totalPaidWithoutCurrent;
        $data["maximumAmount"] = max(0, $maximumAmount);
        $data["header_title"] = "Modifier le versement";

        return view(
            "admin.fees_collection.edit_collect_fees",
            $data
        );
    }

    public function CollectFeesUpdate($id, Request $request)
    {
        $request->validate([
            'student_id' => 'required|integer',
            'class_id' => 'required|integer',
            'amount' => 'required|numeric|min:1',
            'payment_date' => 'required|date',
            'payment_method' => 'required|string|max:50',
            'observation' => 'nullable|string'
        ]);

        $payment = DB::table('student_add_fees')
            ->where('id', $id)
            ->first();

        if (!$payment) {
            return back()
                ->withInput()
                ->with('error', 'Versement introuvable.');
        }

        $studentId = (int) $request->student_id;
        $classId = (int) $request->class_id;
        $newAmount = (float) $request->amount;

        $class = DB::table('class')
            ->where('id', $classId)
            ->first();

        if (!$class) {
            return back()
                ->withInput()
                ->with('error', 'Classe introuvable.');
        }

        $totalAmount = (float) $class->amount;

        $paidWithoutCurrent = (float) DB::table('student_add_fees')
            ->where('student_id', $studentId)
            ->where('id', '!=', $id)
            ->sum('paid_amount');

        $remainingForCurrent = $totalAmount - $paidWithoutCurrent;

        if ($remainingForCurrent < 0) {
            $remainingForCurrent = 0;
        }

        if ($newAmount > $remainingForCurrent) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Le nouveau montant dépasse le reste disponible.'
                );
        }

        $newTotalPaid = $paidWithoutCurrent + $newAmount;

        $newRemaining = $totalAmount - $newTotalPaid;

        if ($newRemaining < 0) {
            $newRemaining = 0;
        }

        DB::table('student_add_fees')
            ->where('id', $id)
            ->update([
                'student_id' => $studentId,
                'class_id' => $classId,
                'total_amount' => $totalAmount,
                'paid_amount' => $newAmount,
                'remaning_amount' => $newRemaining,
                'payment_type' => $request->payment_method,
                'observation' => $request->observation,
                'created_at' => $request->payment_date,
                'updated_at' => now()
            ]);

        return redirect(
            url(
                'admin/fees_collection/collect_fees/add_fees/' .
                    $studentId
            )
        )->with(
            'success',
            'Versement modifié avec succès.'
        );
    }

    public function PaymentReceipt($id)
    {
        $payment = DB::table('student_add_fees')
            ->where('student_add_fees.id', $id)
            ->first();

        if (!$payment) {
            return redirect(
                url('admin/fees_collection/collect_fees')
            )->with('error', 'Paiement introuvable.');
        }

        $student = User::find($payment->student_id);

        if (!$student) {
            return redirect(
                url('admin/fees_collection/collect_fees')
            )->with('error', 'Élève introuvable.');
        }

        $totalPaid = (float) DB::table('student_add_fees')
            ->where('student_id', $payment->student_id)
            ->sum('paid_amount');

        $totalAmount = (float) $payment->total_amount;

        $remainingAmount = max(
            0,
            $totalAmount - $totalPaid
        );

        return view(
            'admin.fees_collection.payment_receipt',
            compact(
                'payment',
                'student',
                'totalAmount',
                'totalPaid',
                'remainingAmount'
            )
        );
    }
}