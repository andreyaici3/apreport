<?php

namespace App\Http\Controllers\ATPayment;

use App\Http\Controllers\Controller;
use App\Models\ATPayment\AuditDetail;
use App\Models\ATPayment\AuditMaster;
use App\Models\ATPayment\MutasiBank;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    public function main()
    {
        return view('atp.audit.main.index', [
            'main' => MutasiBank::orderBy('tanggal', 'DESC')->where([
                ['keterangan', "=", "NOTHING"],
                ['id_detail_audit', "=", NULL]
            ])->get(),
        ]);
    }

    public function maincreate($id_mutasi)
    {
        $mutasi = MutasiBank::find($id_mutasi);
        if ($mutasi->tipe == 'credit') {
            $audit_detail = AuditDetail::where('id_audit_master', '=', 2)->get();
        } else {
            $audit_detail = AuditDetail::where('id_audit_master', '=', 1)->get();
        }

        return view('atp.audit.main.create', [
            'audit' => $audit_detail,
            'mutasi' => $mutasi
        ]);
    }

    public function postcreate(Request $request, $id_mutasi)
    {

        $mutasi = MutasiBank::find($id_mutasi);
        if ($request->catatan == "NOTHING") {
            if ($mutasi->tipe == "credit") {
                $keterangan = "Pemasukan Dari " . AuditDetail::find($request->audit_detail)->name;
            } else {
                $keterangan = "Pengeluaran Untuk " . AuditDetail::find($request->audit_detail)->name;
            }
        } else {
            $keterangan = $request->catatan;
        }

        $mutasi->update([
            'keterangan' => $keterangan,
            'id_detail_audit' => $request->audit_detail,
        ]);

        return $this->result(true, "Dijalankan");
    }

    public function pemasukan()
    {
        return view('atp.audit.pemasukan.index', [
            'pemasukan' => MutasiBank::orderBy('tanggal', 'DESC')->where('id_detail_audit', '!=', 0)->whereHas('audit_detail', function ($query) {
                $query->where('id_audit_master', '=', 2);
            })->get(),
        ]);
    }

    public function destroyaudit($type, $id_mutasi)
    {
        MutasiBank::findOrFail($id_mutasi)->update([
            'keterangan' => "NOTHING",
            'id_detail_audit' => null
        ]);

        if ($type == 'pemasukan') {
            return redirect()->to(route('atp.audit.pemasukan'))->with('sukses', 'audit berhasil digagalkan');
        } else {
            return redirect()->to(route('atp.audit.pengeluaran'))->with('sukses', 'audit berhasil digagalkan');
        }
    }

    public function pengeluaran()
    {
        return view('atp.audit.pengeluaran.index', [
            'pemasukan' => MutasiBank::orderBy('tanggal', 'DESC')->where('id_detail_audit', '!=', 0)->whereHas('audit_detail', function ($query) {
                $query->where('id_audit_master', '=', 1);
            })->get(),
        ]);
    }

    private function result($bool = true, $messages = "")
    {
        if ($bool) {
            return redirect()->to(route('atp.audit.main'))->with('sukses', "Audit Berhasil Di $messages");
        } else {
            return redirect()->to(route('atp.audit.main'))->with('gagal', "Audit Gagal Di $messages");
        }
    }
}
