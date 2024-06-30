<?php

namespace App\Http\Controllers\ATPayment;

use App\Http\Controllers\Controller;
use App\Http\Requests\ATPayment\MutasiBankRequest;
use App\Models\ATPayment\Bank;
use App\Models\ATPayment\Modul;
use App\Models\ATPayment\MonitorModul;
use App\Models\ATPayment\MutasiBank;
use App\Models\ATPayment\MutasiModul;

class MutasiBankController extends Controller
{
    public function index()
    {
        return view('atp.mutasi.index', [
            'bank' => Bank::get(),
        ]);
    }

    public function detail($id)
    {
        $banks = Bank::where('id',$id)->with(['mutasi' => function ($query) {
            $query->orderBy('tanggal', 'desc')->take(500);
        }])->first();
        return view('atp.mutasi.detail', [
            'bank' => $banks
        ]);
    }

    public function create($id_bank)
    {
        return view("atp.mutasi.create", [
            'bank' => Bank::find($id_bank),
            'modul' => Modul::get(),
            'ids' => $id_bank,
        ]);
    }

    public function store(MutasiBankRequest $request, $id_bank)
    {
        $bank = Bank::find($id_bank);
        $tipe_mutasi = $request->tipe_mutasi;
        $deposit_rs = $request->deposit_rs;
        $id_modul = $request->deposit_spl;
        if ($tipe_mutasi == "credit"){
            if ($deposit_rs == "on"){
                $keterangan = "Deposit Resseler";
                $deposit_rs = 1;
            } else {
                $keterangan = "NOTHING";
                $deposit_rs = 0;
            }
            MutasiBank::create([
                'id_bank' => $bank->id,
                'keterangan' => $keterangan,
                'tanggal' => $request->tanggal,
                'tipe' => "credit",
                'amount' => $request->amount,
                'deposit_rs' => $deposit_rs,
            ]);
            $bank->update([
                'sisa_saldo' => $bank->sisa_saldo + $request->amount
            ]);
            return $this->result(true, "Tambah", $bank->id);
        } else {
            if ($id_modul == 0){
                $keterangan = "NOTHING";
                $id_modul = null;
                $deposit_spl = 0;
                $id_mutasi_modul = null;
            } else {
                $deposit_spl = 1;
                $modul = Modul::find($id_modul);
                $keterangan = 'Deposit Dari ' . $bank->kode_bank . " Ke " . $modul->nama_modul;
                $valueMutasiModul = [
                    'id_modul' => $id_modul,
                    "tanggal" => $request->tanggal,
                    'keterangan' => $keterangan,
                    'jumlah' => $request->amount,
                ];
                $mutasi = MutasiModul::create($valueMutasiModul);
                $id_mutasi_modul = $mutasi->id;
                $cekMonitor = MonitorModul::where([
                    ['id_modul', "=", $id_modul],
                    ['tanggal', "=", $request->tanggal]
                ]);
                if ($cekMonitor->count() > 0) {
                    $penambahanSaldoAwal = $cekMonitor->first()->penambahan_saldo;
                    $penambahanSaldoAkhir = $penambahanSaldoAwal + $request->amount;
                    $cekMonitor->update([
                        'penambahan_saldo' => $penambahanSaldoAkhir
                    ]);
                } else {
                    //monitor belum ada
                    MonitorModul::create([
                        'id_modul' => $id_modul,
                        'tanggal' => $request->tanggal,
                        'saldo_awal' => 0,
                        'penambahan_saldo' => $request->amount,
                    ]);
                }
            }
            MutasiBank::create([
                'id_bank' => $bank->id,
                'keterangan' => $keterangan,
                'tanggal' => $request->tanggal,
                'tipe' => "debit",
                'amount' => $request->amount,
                'deposit_spl' => $deposit_spl,
                'id_modul' => $id_modul ?? null,
                'id_mutasi_modul' => $id_mutasi_modul,
            ]);
            $bank->update([
                'sisa_saldo' => $bank->sisa_saldo - $request->amount
            ]);
            return $this->result(true, "Tambah", $bank->id);
        }
    }

    public function destroy($id_bank, $id_mutasi)
    {
        try {
            $bank = Bank::find($id_bank);
            $mutasi_bank = MutasiBank::find($id_mutasi);
            if ($mutasi_bank->tipe == "debit"){
                //mutasi debit
                if ($mutasi_bank->deposit_spl == 1){
                    $mutasi_modul  = MutasiModul::find($mutasi_bank->id_mutasi_modul);
                    $jumlah = $mutasi_modul->jumlah;
                    $monitor_modul = MonitorModul::where([
                        ["tanggal", "=", $mutasi_modul->tanggal],
                        ["id_modul", "=", $mutasi_modul->id_modul]
                    ]);
                    $penambahan = $monitor_modul->first()->penambahan_saldo;
                    $monitor_modul->update([
                        'penambahan_saldo' => $penambahan - $jumlah
                    ]);
                    $mutasi_bank->delete();
                    $mutasi_modul->delete();
                } else {
                    $jumlah = $mutasi_bank->amount;
                    $mutasi_bank->delete();
                }
                $bank->update([
                    'sisa_saldo' => $bank->sisa_saldo + $jumlah
                ]);
                return $this->result(true, "Hapus", $bank->id);
            } else {
                $jumlah = $mutasi_bank->amount;
                $bank->update([
                    'sisa_saldo' => $bank->sisa_saldo - $jumlah
                ]);
                $mutasi_bank->delete();
                return $this->result(true, "Hapus", $bank->id);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return $e;
            return $this->result(false, "Hapus", $bank->id);
        }
    }

    private function result($bool = true, $messages = "", $id)
    {
        if ($bool) {
            return redirect()->to(route('atp.bank.mutasi.detail', ['id' => $id]))->with('sukses', "Mutasi Berhasil Di $messages");
        } else {
            return redirect()->to(route('atp.bank.mutasi.detail', ['id' => $id]))->with('gagal', "Mutasi Gagal Di $messages");
        }
    }
}
