<?php

namespace App\Http\Controllers\ATPayment;

use App\Http\Controllers\Controller;
use App\Models\ATPayment\Bank;
use App\Models\ATPayment\DepositOtomax;
use Illuminate\Http\Request;

class MonitoringDepositController extends Controller
{
    public function index()
    {
        return view('atp.monitoring.saldo.index',[
            'mutasi' => DepositOtomax::orderBy('tanggal', 'DESC')->get(),
            'bank' => Bank::get(),
        ]);
    }
}
