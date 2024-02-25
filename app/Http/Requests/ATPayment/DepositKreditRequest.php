<?php

namespace App\Http\Requests\ATPayment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DepositKreditRequest extends FormRequest
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
            "id_agen" => ["required"],
            "nominal" => ["required"],
        ];
    }

    public function messages() : array
    {
        return [
            'id_agen.required' => "Kode Agen Tidak Boleh Kosong",
            'nominal.required' => "Nominal Tidak Boleh Kosong",
        ];
    }
}
