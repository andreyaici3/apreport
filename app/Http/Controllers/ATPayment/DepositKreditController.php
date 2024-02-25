<?php

namespace App\Http\Controllers\ATPayment;

use App\Http\Controllers\Controller;
use App\Http\Requests\ATPayment\DepositKreditRequest;
use App\Models\ATPayment\DepositKredit;
use Illuminate\Http\Request;

class DepositKreditController extends Controller
{
    public function index()
    {
        return view("atp.deposit.kredit.index", [
            'kredit' => DepositKredit::get()
        ]);
    }

    public function create()
    {
        return view("atp.deposit.kredit.create");
    }

    public function store(DepositKreditRequest $request)
    {
        try {
            DepositKredit::create($request->all());       
            return $this->result(true, "Di Tambahkan");
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->result(false, "Di Tambahkan");
        }   
    }

    public function edit($id)
    {
        return view('atp.deposit.kredit.edit', [
            'kredit' => DepositKredit::find($id)
        ]);
    }

    public function update(DepositKreditRequest $request, $id)
    {
        try {
            DepositKredit::find($id)->update($request->all());
            return $this->result(true, "Di Ubah");
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->result(false, "Di Ubah");
        }
    }

    public function destroy($id)
    {
        try {
            DepositKredit::find($id)->delete();
            return $this->result(true, "Di Hapus");
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->result(false, "Di Hapus");
        }
    }

    private function result($bool = true, $messages = "")
    {
        if ($bool) {
            return redirect()->to(route('atp.deposit.kredit'))->with('sukses', "Deposit Berhasil Di $messages");
        } else {
            return redirect()->to(route('atp.deposit.kredit'))->with('gagal', "Deposit Gagal Di $messages");
        }
    }
}
