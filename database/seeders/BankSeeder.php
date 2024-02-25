<?php

namespace Database\Seeders;

use App\Models\ATPayment\Bank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    public function run(): void
    {
        collect([
            [
                'kode_bank' => "BRI BISNIS",
                'nama_bank' => "Bank Rakyat Indonesia",
                'sisa_saldo' => "33177849",
                'norek' => '013301001717566'
            ],
            [
                'kode_bank' => "BCA",
                'nama_bank' => "Bank Central Asia",
                'sisa_saldo' => "21230700",
                'norek' => '123456789'
            ],
            [
                'kode_bank' => "BNI",
                'nama_bank' => "Bank Negara Indonesia",
                'sisa_saldo' => "6138888",
                'norek' => '1439361406'
            ],
            [
                'kode_bank' => "MANDIRI",
                'nama_bank' => "Bank Mandiri",
                'sisa_saldo' => "2481132",
                'norek' => '1340023555179'
            ],
            [
                'kode_bank' => "TUNAI",
                'nama_bank' => "UANG TUNAI",
                'sisa_saldo' => "1000000",
                'norek' => '123456789'
            ],
            

            
        ])->each(function ($bank) {
            Bank::create($bank);
        });
    }
}
