<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ExamModel;
use App\Models\ExamScheduleModel;
use App\Models\NoticeBoardModel;
use App\Models\SubjectModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data["header_title"] = "Dashboard";
        if (!empty(Auth::check())) {
            if (Auth::user()->user_type == 1) {

                $data["TotalAdmin"] = User::getTotalUser(1);
                $data["TotalTeacher"] = User::getTotalUser(2);
                $data["TotalStudent"] = User::getTotalUser(3);
                $data["TotalParent"] = User::getTotalUser(4);
                $data["getTotalTodayFees"] = User::getTotalTodayFees();
                $data["feesTotal"] = User::getTotalSchoolFees();
                $data["feesCollected"] = User::getTotalPaidSchoolFees();
                $data["feesRemaining"] = User::getTotalRemainingSchoolFees();
                $data["TotalNoticeBoard"] = NoticeBoardModel::getTotalNoticeBoard();
                $data["feesPercentage"] = User::getSchoolFeesPercentage();
                $data["remainingPercentage"] = User::getRemainingSchoolFeesPercentage();
                $data["TotalSession"] = ExamModel::getTotalSession();
                $data["examScheduleCount"] = ExamScheduleModel::getTotalExamSchedules();
                $data["TotalClass"] = ClassModel::getTotalClass();
                $data["TotalSubject"] = SubjectModel::getTotalSubject();
                $data["classStatistics"] = ClassModel::getClassStatistics();


                return view("admin.dashboard", $data);
            } elseif (Auth::user()->user_type == 2) {
                return view("teacher.dashboard", $data);
            } elseif (Auth::user()->user_type == 3) {
                return view("student.dashboard", $data);
            } elseif (Auth::user()->user_type == 4) {
                return view("parent.dashboard", $data);
            }
        }
    }
}