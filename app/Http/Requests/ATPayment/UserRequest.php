<?php

namespace App\Http\Requests\ATPayment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        if (Auth::user()->role == "superuser")
            return true;

        return false;
    }

    public function rules(): array
    {
        switch ($this->method()) {
            case "PUT":
                return [
                    "name" => ["required"],
                ];
                break;
            default:
                return [
                    "name" => ["required"],
                    "email" => ["required", "email", "unique:users"],
                    "password" => ["required"],
                ];
                break;
        }
    }

    public function messages(): array
    {
        return [
            "name.required" => "Nama Tidak Boleh Kosong",
            "email.required" => "Email Tidak Boleh Kosong",
            "email.unique" => "Email Sudah Terdaftar",
        ];
    }
}
