<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateAdminResquest extends FormRequest
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
            "name" => "required|string|unique:users,name",
            "email" => "required|email|unique:users,email",
        ];
    }

    public function messages()
    {
        return [
            "email" => "La modification de l'email est requis",
            "name" => "La modification du nom complet de l'administrateur est requis",
        ];
    }
}
