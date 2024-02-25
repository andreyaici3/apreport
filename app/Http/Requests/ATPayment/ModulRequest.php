<?php

namespace App\Http\Requests\ATPayment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ModulRequest extends FormRequest
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
            "kode_modul" => ["required"],
            "nama_modul" => ["required"],
        ];
    }

    public function messages() : array
    {
        return [
            'kode_modul.required' => "Kode Modul Tidak Boleh Kosong",
            'nama_modul.required' => "Nama Modul Tidak Boleh Kosong",
            'kode_modul.unique' => "Kode Modul Sudah Ada",
        ];
    }
}
