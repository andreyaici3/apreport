<?php

namespace App\Http\Requests\ATPayment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BankRequest extends FormRequest
{
    public function authorize(): bool
    {
        if (Auth::user()->role == "superuser")
            return true;

        return false;
    }

    public function rules(): array
    {
        return [
            'kode_bank' => ['required'],
            'nama_bank' => ['required'],
            'norek' => ['required']
        ];
    }
}
