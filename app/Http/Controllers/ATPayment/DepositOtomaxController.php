<?php

namespace App\Http\Controllers\ATPayment;

use App\Http\Controllers\Controller;
use App\Http\Requests\ATPayment\DepositOtomaxRequest;
use App\Models\ATPayment\Bank;
use App\Models\ATPayment\DepositOtomax;
use Illuminate\Http\Request;

class DepositOtomaxController extends Controller
{
    public function index()
    {        
        return view('atp.deposit.otomax.index', [
            'otomax' =>DepositOtomax::orderBy('tanggal', 'DESC')->get(),
        ]);
    }

    public function create()
    {
        return view('atp.deposit.otomax.create');
    }

    public function store(DepositOtomaxRequest $request)
    {
        try {
            DepositOtomax::create($request->all());       
            return $this->result(true, "Di Tambahkan");
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->result(false, "Di Tambahkan");
        }   
    }

    public function edit($id)
    {
        return view('atp.deposit.otomax.edit', [
            'otomax' => DepositOtomax::find($id)
        ]);
    }

    public function update(DepositOtomaxRequest $request, $id)
    {
        try {
            DepositOtomax::find($id)->update($request->all());
            return $this->result(true, "Di Ubah");
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->result(false, "Di Ubah");
        }
    }

    public function destroy($id)
    {
        try {
            DepositOtomax::find($id)->delete();
            return $this->result(true, "Di Hapus");
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->result(false, "Di Hapus");
        }
    }

    private function result($bool = true, $messages = "")
    {
        if ($bool) {
            return redirect()->to(route('atp.deposit.otomax'))->with('sukses', "Deposit Berhasil Di $messages");
        } else {
            return redirect()->to(route('atp.deposit.otomax'))->with('gagal', "Deposit Gagal Di $messages");
        }
    }
}
