<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
 
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => "required",
            "password" => "required"
        ];
    }

    public function messages():array
    {
        return [
            "email.required" => "Email Tidak Boleh Kosong",
            "password.required" => "Password Tidak Boleh Kosong"
        ];
    }
}
