<?php

namespace App\Http\Requests\ATPayment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DepositOtomaxRequest extends FormRequest
{
    public function authorize(): bool
    {
        if (Auth::user()->role == "superuser" || Auth::user()->role == "karyawan")
            return true;

        return false;
    }

    public function rules()
    {
        return [
            "nominal" => ["required"],
        ];
    }

    public function messages() : array
    {
        return [
            'nominal.required' => "Nominal Tidak Boleh Kosong",
        ];
    }
}
