<?php

namespace App\Http\Controllers\ATPayment;

use App\Http\Controllers\Controller;
use App\Models\ATPayment\Modul;

class MutasiModulController extends Controller
{
    public function index()
    {
        return view('atp.mutasi.modul.index', [
            'modul' => Modul::get(),
        ]);
    }

    public function detail($id)
    {
        return view('atp.mutasi.modul.detail', [
            'modul' => Modul::find($id)
        ]);
    }

    public function create($id_modul)
    {
        return view("atp.mutasi.modul.create", [
            'modul' => Modul::find($id_modul),
        ]);
    }
}
