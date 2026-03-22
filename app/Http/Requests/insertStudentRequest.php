<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class insertStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|string",
            "last_name" => "required|string",
            "email" => "required|email|unique:users,email",
            "admission_number" => "required|string",
            "roll_number" => "required|string",
            "gender" => "required|string",
            "date_of_birth" => "required|date",
            "admission_date" => "required|date",
            "password" => "required"
        ];
    }


    public function messages()
    {
        return [

            "name.required" => "le nom de est requis",
            "email.required" => "L'email est requis",
            "email.unique" => "L'email est dejà utilisé",
            "email.email" => "l'email n'est pas valide",
            "last_name.required" => "le prénom de est requis",
            "admission_number.required" => "le numero d'admission de est requis",
            "roll_number.required" => "le numero matricule de est requis",
            "gender.required" => "le genre de est requis",
            "date_of_birth.required" => "la date de naissance est requise",
            "password.required" => "le mot de passe est requis"
        ];
    }
}