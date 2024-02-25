<?php

namespace App\Http\Controllers\ATPayment;

use App\Http\Controllers\Controller;
use App\Http\Requests\ATPayment\MutasiBankRequest;
use App\Models\ATPayment\Bank;
use App\Models\ATPayment\Modul;
use App\Models\ATPayment\MonitorModul;
use App\Models\ATPayment\MutasiBank;
use App\Models\ATPayment\MutasiModul;
use GuzzleHttp\Promise\Create;

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
        return view('atp.mutasi.detail', [
            'bank' => Bank::find($id)
        ]);
    }

    public function create($id_bank)
    {
        return view("atp.mutasi.create", [
            'bank' => Bank::find($id_bank),
            'modul' => Modul::get(),
        ]);
    }

    public function store(MutasiBankRequest $request, $id_bank)
    {
        try {
            $bank = Bank::find($id_bank);
            if ($request->tipe_mutasi == "debit") {
                $saldo_akhir = $bank->sisa_saldo - $request->amount;
            } else {
                $saldo_akhir = $bank->sisa_saldo + $request->amount;
            }
            if ($request->deposit_spl == "0" && $request->deposit_rs == null) {
                $keterangan = "NOTHING";
                $deposit_spl = 0;
                $deposit_rs = 0;
                $id_modul = NULL;
            } else if ($request->deposit_spl == "0" && $request->deposit_rs != null) {
                $keterangan = "Deposit Resseler";
                $deposit_spl = 0;
                $deposit_rs = 1;
                $id_modul = NULL;
            } else {
                $deposit_spl = 1;
                $deposit_rs = 0;
                $id_modul = $request->deposit_spl;
                $keterangan = "Deposit Ke " . Modul::find($request->deposit_spl)->nama_modul;
                $mutasi = MutasiModul::create([
                    'id_modul' => $id_modul,
                    'tanggal' => $request->tanggal,
                    'keterangan' => 'Deposit Dari ' . $bank->kode_bank,
                    'jumlah' => $request->amount,
                ]);
                $cekMonitor = MonitorModul::where([
                    ['id_modul', "=", $id_modul],
                    ['tanggal', "=", $request->tanggal]
                ]);

                //jumlahkan saldo
                $penambahan = MutasiModul::where([
                    ['tanggal', '=', $request->tanggal],
                    ['id_modul', '=', $id_modul]
                ])->sum('jumlah');

                if ($cekMonitor->count() > 0) {
                    $cekMonitor->update([
                        'penambahan_saldo' => $penambahan,
                    ]);
                } else {
                    MonitorModul::create([
                        'id_modul' => $id_modul,
                        'tanggal' => $request->tanggal,
                        'saldo_awal' => 0,
                        'penambahan_saldo' => $penambahan,
                    ]);
                }
            }

            MutasiBank::create([
                'id_bank' => $bank->id,
                'tanggal' => $request->tanggal,
                "keterangan" => $keterangan,
                'tipe' => $request->tipe_mutasi,
                'amount' => $request->amount,
                'deposit_rs' => $deposit_rs,
                'deposit_spl' => $deposit_spl,
                'id_modul' => $id_modul,
                'id_mutasi_modul' => $mutasi->id ?? null
            ]);
            $bank->update([
                'sisa_saldo' => $saldo_akhir
            ]);

            return $this->result(true, "Tambah", $bank->id);
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->result(false, "Tambah", $bank->id);
        }
    }

    public function destroy($id_bank, $id_mutasi)
    {
        try {
            $bank = Bank::find($id_bank);
            $mutasi_bank = MutasiBank::find($id_mutasi);
            if ($mutasi_bank->deposit_spl == 1) {
                $mutasi_modul = MutasiModul::find($mutasi_bank->id_mutasi_modul);
                $jumlah_mutasi = $mutasi_modul->jumlah;
                $saldo_akhir = $bank->sisa_saldo + $jumlah_mutasi;
                $tgl = $mutasi_modul->tanggal;
                $id_modul = $mutasi_modul->id_modul;
                $mutasi_bank->delete();
                $mutasi_modul->delete();
                $penambahan = MutasiModul::where([
                    ['tanggal', '=', $tgl],
                    ['id_modul', '=', $id_modul]
                ])->sum('jumlah');

                MonitorModul::where([
                    ['tanggal', "=", $tgl]
                ])->update([
                    'penambahan_saldo' => $penambahan
                ]);                
                
            } else {
                
                $jumlah = $bank->sisa_saldo + $mutasi_bank->amount;
                $mutasi_bank->delete();
                $saldo_akhir = $jumlah;
            }
            $bank->update([
                'sisa_saldo' => $saldo_akhir
            ]);

            return $this->result(true, "Hapus", $bank->id);

        } catch (\Illuminate\Database\QueryException $e) {
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
