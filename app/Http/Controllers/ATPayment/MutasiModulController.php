<?php

namespace App\Http\Controllers\ATPayment;

use App\Http\Controllers\Controller;
use App\Models\ATPayment\DepositOtomax;
use App\Models\ATPayment\Modul;
use App\Models\ATPayment\MonitorModul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'dep' => DepositOtomax::get(),
            'id' => $id,
            'modul' => Modul::find($id)
        ]);
    }

    public function create($id_modul)
    {
        return view("atp.mutasi.modul.create", [
            'modul' => Modul::find($id_modul),
        ]);
    }

    public function update_akhir($id){
        return view("atp.mutasi.modul.akhir", [
            'monitor' => MonitorModul::find($id),
        ]);
    }

    public function update_saldo_akhir(Request $request, $id)
    {
        try {
            $monitor = MonitorModul::find($id);
            if (Auth::user()->role == "superuser"){
                $monitor->update([
                    'sisa_saldo' => $request->saldo_akhir,
                    'pembelian_oto' => $request->pembelian_otomax,
                    'penjualan_oto' => $request->penjualan_otomax,
                ]);
            } else  {
                $monitor->update([
                    'sisa_saldo' => $request->saldo_akhir
                ]);
            }
            
            return $this->result(true, "Update", $monitor->modul->id);
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->result(false, "Update", $monitor->modul->id);
        }
        
    }

    public function createmonitor($tanggal, $id_modul){
        try {
            MonitorModul::create([
                'tanggal' => $tanggal,
                'id_modul' => $id_modul
            ]);
            return $this->result(true, "Tambahkan", $id_modul);
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->result(false, "Tambahkan", $id_modul);
        }
    }

    public function syncsaldoawal($tanggal, $id_modul)
    {
        $before = date('Y-m-d', strtotime('-1 day', strtotime($tanggal)));
        $monitor = MonitorModul::where([
            ['tanggal', "=", $before],
            ['id_modul', "=", $id_modul]
        ]);

        if ($monitor->count() > 0){
            MonitorModul::where([
                ['tanggal', "=", $tanggal],
                ['id_modul', "=", $id_modul]
            ])->update([
                'saldo_awal' => $monitor->first()->sisa_saldo
            ]);
            return $this->result(true, "Update", $id_modul);
        } else {
            return $this->result(false, "Update", $id_modul);
        }
        
    }

    private function result($bool = true, $messages = "", $id)
    {
        if ($bool) {
            return redirect()->to(route('atp.modul.mutasi.detail', ['id' => $id]))->with('sukses', "Mutasi Berhasil Di $messages");
        } else {
            return redirect()->to(route('atp.modul.mutasi.detail', ['id' => $id]))->with('gagal', "Mutasi Gagal Di $messages");
        }
    }
}


