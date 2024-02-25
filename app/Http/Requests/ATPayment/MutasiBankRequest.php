<?php

namespace App\Http\Requests\ATPayment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MutasiBankRequest extends FormRequest
{
    public function authorize(): bool
    {
        if (Auth::user()->role == "superuser" || Auth::user()->role == "karyawan")
            return true;

        return false;
    }

    public function rules(): array
    {
        return [
            "amount" => ['required'],
            'tipe_mutasi' => ['required']
        ];
    }
}
