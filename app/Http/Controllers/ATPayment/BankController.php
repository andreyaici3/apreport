<?php

namespace App\Http\Controllers\ATPayment;

use App\Http\Controllers\Controller;
use App\Http\Requests\ATPayment\BankRequest;
use App\Http\Requests\ATPayment\UserRequest;
use App\Models\ATPayment\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index()
    {
        return view('atp.master.bank.index', [
            'bank' => Bank::get(),
        ]);
    }

    public function create()
    {
        return view('atp.master.bank.create');
    }

    public function edit($id)
    {
        return view('atp.master.bank.edit', ['bank' => Bank::findOrFail($id)]);
    }

    public function update(BankRequest $request, $id)
    {
        try {
            $bank = Bank::find($id);
            $bank->update([
                'nama_bank' =>  $request->nama_bank,
                'norek' => $request->norek,
            ]);
            $this->storeLog("Mengubah Data " . $bank->kode_bank . " " . $bank->norek);
            return $this->result(true, "Di Update");
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->result(false, "Di Update");
        } 
    }

    public function store(BankRequest $request)
    {
        try {
            $bank = Bank::create([
                'kode_bank' =>  $request->kode_bank,
                'nama_bank' => $request->nama_bank,
                'norek' => $request->norek,
                'sisa_saldo' => 0,
            ]);
            $this->storeLog("Menambahkan " . $bank->kode_bank . " " . $bank->norek);
            return $this->result(true, "Di Tambahkan");
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->result(false, "Di Tambahkan");
        }
    }

    public function destroy($id)
    {
        try {
            $bank = Bank::find($id);
            $this->storeLog("Menghapus " . $bank->kode_bank . " " . $bank->norek);
            $bank->delete();
            return $this->result(true, "Hapus");
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->result(false, "Hapus");
        }
    }

    private function result($bool = true, $messages = "")
    {
        if ($bool) {
            return redirect()->to(route('atp.bank'))->with('sukses', "Bank Berhasil Di $messages");
        } else {
            return redirect()->to(route('atp.bank'))->with('gagal', "Bank Gagal Di $messages");
        }
    }
}
