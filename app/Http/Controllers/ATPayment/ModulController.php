<?php

namespace App\Http\Controllers\ATPayment;

use App\Http\Controllers\Controller;
use App\Http\Requests\ATPayment\ModulRequest;
use App\Models\ATPayment\Modul;

class ModulController extends Controller
{
    public function index()
    {
        return view('atp.master.modul.index', [
            'modul' => Modul::get(),
        ]);
    }

    public function create()
    {
        return view('atp.master.modul.create');
    }

    public function edit($id)
    {
        return view('atp.master.modul.edit', ['modul' => Modul::findOrFail($id)]);
    }

    public function store(ModulRequest $request)
    {
        try {
            Modul::create([
                'nama_modul' =>  $request->nama_modul,
                'kode_modul' => $request->kode_modul,
                'sisa_saldo' => 0,
            ]);
            return $this->result(true, "Di Tambahkan");
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->result(false, "Di Tambahkan");
        }
    }

    public function update(ModulRequest $request, $id)
    {
        try {
            Modul::find($id)->update([
                'nama_modul' =>  $request->nama_modul,
                'kode_modul' => $request->kode_modul,
            ]);
            return $this->result(true, "Di Ubah");
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->result(false, "Di Ubah");
        }
    }

    public function destroy($id)
    {
        try {
            Modul::find($id)->delete();
            return $this->result(true, "Hapus");
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->result(false, "Hapus");
        }
    }

    private function result($bool = true, $messages = "")
    {
        if ($bool) {
            return redirect()->to(route('atp.modul'))->with('sukses', "Modul Berhasil Di $messages");
        } else {
            return redirect()->to(route('atp.modul'))->with('gagal', "Modul Gagal Di $messages");
        }
    }
}
