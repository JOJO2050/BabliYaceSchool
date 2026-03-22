<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

use App\Mail\ForgotPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class AuthController extends Controller
{
    public function login()
    {
        // dd(Hash::make("azerty"));
        return view("auth.login");


        if (!empty(Auth::check())) {
            if (Auth::user()->user_type == 1) {
                return redirect("admin/dashboard");
            } elseif (Auth::user()->user_type == 2) {
                return redirect("teacher/dashboard");
            } elseif (Auth::user()->user_type == 3) {
                return redirect("student/dashboard");
            } elseif (Auth::user()->user_type == 4) {
                return redirect("parent/dashboard");
            }
        }

        return view("auth.login");
    }



    public function AuthLogin(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;
        if (Auth::attempt(["email" => $request->email, "password" => $request->password], $remember)) {

            if (Auth::user()->user_type == 1) {
                return redirect("admin/dashboard");
            } elseif (Auth::user()->user_type == 2) {
                return redirect("teacher/dashboard");
            } elseif (Auth::user()->user_type == 3) {
                return redirect("student/dashboard");
            } elseif (Auth::user()->user_type == 4) {
                return redirect("parent/dashboard");
            }
        } else {
            return redirect()->back()->with("error", "Veillez entrer un email ou un mot de passe valide");
        }
    }

    public function forgotpassword()
    {
        return view("auth.forgot");
    }

    public function PostForgotpassword(Request $request)
    {
        $user = User::getEmailSingle($request->email);
        if (!empty($user)) {

            $user->remember_token = Str::random(30);
            $user->save();
            Mail::to($user->email)->send(new ForgotPasswordMail($user));

            return redirect()->back()->with("success", "Veillez verifier votre boite email, un message de réinitialisation vient de vous êtes envoyé.");
        } else {
            return redirect()->back()->with("error", "Veillez entrer un email existant");
        }
    }


    public function reset($remember_token)
    {
        $user = User::getTokenSingle($remember_token);
        if (!empty($user)) {
            $data["user"] = $user;
            return view("auth.reset", $data);
        } else {
            abort(404);
        }
    }

    public function PostReset($token, Request $request)
    {

        if ($request->password == $request->password_confirmation) {
            $user = User::getTokenSingle($token);
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->save();
            return  redirect("/")->with('success', 'Votre mot de passe a bien été modifié . ');
        } else {
            return back()->with('error', 'les mots de passes saisient sont differents');
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect(url(""));
    }
}
