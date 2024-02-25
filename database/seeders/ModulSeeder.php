<?php

namespace Database\Seeders;

use App\Models\ATPayment\Modul;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            [
                'kode_modul' => "LAPAN",
                'nama_modul' => "Lapan Lapan",
                'sisa_saldo' => 3919390
            ],
            [
                'kode_modul' => "DIGI",
                'nama_modul' => "Digi Flazz",
                'sisa_saldo' => 2527581,
            ],
            [
                'kode_modul' => "WIPAY",
                'nama_modul' => "Wijaya Payment",
                'sisa_saldo' => 8376101,
            ],
            [
                'kode_modul' => "1112",
                'nama_modul' => "11 12 Reload",
                'sisa_saldo' => 8505238,
            ],
            [
                'kode_modul' => "BRH",
                'nama_modul' => "BRH Reload",
                'sisa_saldo' => 5976097,
            ],
            [
                'kode_modul' => "JMC",
                'nama_modul' => "JMC Multi Payment",
                'sisa_saldo' => 3410731,
            ],
            [
                'kode_modul' => "LOOK",
                'nama_modul' => "Look At Me",
                'sisa_saldo' => 1525514,
            ],
            [
                'kode_modul' => "AMP",
                'nama_modul' => "Azkal Multi Payment",
                'sisa_saldo' => 153346,
            ],
            [
                'kode_modul' => "LIKEPAY",
                'nama_modul' => "Like Pay",
                'sisa_saldo' => 496229,
            ],
            [
                'kode_modul' => "MR",
                'nama_modul' => "MR Pulsa",
                'sisa_saldo' => 372,
            ],
            [
                'kode_modul' => "YOT",
                'nama_modul' => "YOT Reload",
                'sisa_saldo' => 3135493,
            ],
            

        ])->each(function ($modul) {
            Modul::create($modul);
        });
    }
}
