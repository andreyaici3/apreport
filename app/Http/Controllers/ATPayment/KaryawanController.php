<?php

namespace App\Http\Controllers\ATPayment;

use App\Http\Controllers\Controller;
use App\Http\Requests\ATPayment\UserRequest;
use App\Models\ATPayment\CatatanAktivitas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KaryawanController extends Controller
{
    public function index()
    {
        return view('atp.master.karyawan.index', [
            'karyawan' => User::where('role', "!=", "superuser")->get(),
        ]);
    }

    public function create()
    {
        return view('atp.master.karyawan.create');
    }

    public function edit($id)
    {
        return view('atp.master.karyawan.edit', ['user' => User::findOrFail($id)]);
    }

    public function update(UserRequest $request, $id)
    {
        try {
            $users = User::find($id);
            $users->update([
                'name' =>  $request->name,
            ]);
            //Log
            $user = Auth::user();
            CatatanAktivitas::create([
                'log' => $user->name . " Mengubah $users->name "
            ]);
            return $this->result(true, "Di Update");
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->result(false, "Di Update");
        } 
    }

    public function store(UserRequest $request)
    {
        try {
            $create = User::create([
                'name' =>  $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);
            $user = Auth::user();
            CatatanAktivitas::create([
                'log' => $user->name . " Menambahkan $create->name "
            ]);
            return $this->result(true, "Di Tambahkan");
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->result(false, "Di Tambahkan");
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::find($id);
            CatatanAktivitas::create([
                'log' => $user->name . " Menghapus $user->name "
            ]);
            $user->delete();
            return $this->result(true, "Hapus");
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->result(false, "Hapus");
        }
    }

    private function result($bool = true, $messages = "")
    {
        if ($bool) {
            return redirect()->to(route('atp.karyawan'))->with('sukses', "Karyawan Berhasil Di $messages");
        } else {
            return redirect()->to(route('atp.karyawan'))->with('gagal', "Karyawan Gagal Di $messages");
        }
    }
}
