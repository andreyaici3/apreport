<?php

namespace App\Http\Controllers\ATPayment;

use App\Http\Controllers\Controller;
use App\Models\ATPayment\DepositOtomax;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('atp.report.report', [
            'rep' => DepositOtomax::orderBy('tanggal', 'desc')->get(),
        ]);
    }
}
