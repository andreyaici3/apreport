<?php

namespace App\Http\Controllers;

use App\Models\ATPayment\CatatanAktivitas;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function storeLog($pesan){
        $user = Auth::user();
        CatatanAktivitas::create([
            'log' => $user->name . " " . $pesan
        ]);
    }
}
