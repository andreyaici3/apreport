<?php

use App\Http\Controllers\ATPayment\AuditController;
use App\Http\Controllers\ATPayment\BankController;
use App\Http\Controllers\ATPayment\DepositKreditController;
use App\Http\Controllers\ATPayment\DepositOtomaxController;
use App\Http\Controllers\ATPayment\KaryawanController;
use App\Http\Controllers\ATPayment\ModulController;
use App\Http\Controllers\ATPayment\MonitoringDepositController;
use App\Http\Controllers\ATPayment\MutasiBankController;
use App\Http\Controllers\ATPayment\MutasiModulController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DashboardController;
use App\Models\ATPayment\DepositOtomax;
use Illuminate\Support\Facades\Route;

Route::middleware(["auth", "user-role:superuser|karyawan|finance"])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name("dashboard");
});


Route::controller(AuthenticationController::class)->group(function () {
    Route::get("/login", 'login')->name('auth.login');
    Route::get("/change-password", 'changePassword')->name('auth.change');
    Route::put("/change-password", 'storePassword');
    Route::post("/login", "storeLogin");
    Route::post("/logout", "logout")->name("auth.logout");
});


Route::middleware(["auth", "user-role:superuser"])->group(function () {
    Route::controller(KaryawanController::class)->group(function () {
        Route::get('/karyawan', 'index')->name("atp.karyawan");
        Route::get('/karyawan/create', 'create')->name("atp.karyawan.create");
        Route::get('/karyawan/{id}/edit', 'edit')->name("atp.karyawan.edit");
        Route::put('/karyawan/{id}', 'update')->name("atp.karyawan.update");
        Route::post('/karyawan', 'store');
        Route::delete('/karyawan/{id}', 'destroy')->name("atp.karyawan.delete");
    });

    Route::controller(ModulController::class)->group(function () {
        Route::get('/modul', 'index')->name("atp.modul");
        Route::get('/modul/create', 'create')->name("atp.modul.create");
        Route::get('/modul/{id}/edit', 'edit')->name("atp.modul.edit");
        Route::put('/modul/{id}', 'update')->name("atp.modul.update");
        Route::post('/modul', 'store');
        Route::delete('/modul/{id}', 'destroy')->name("atp.modul.delete");
    });

    Route::controller(BankController::class)->group(function () {
        Route::get('/bank', 'index')->name("atp.bank");
        Route::get('/bank/create', 'create')->name("atp.bank.create");
        Route::get('/bank/{id}/edit', 'edit')->name("atp.bank.edit");
        Route::put('/bank/{id}', 'update')->name("atp.bank.update");
        Route::post('/bank', 'store');
        Route::delete('/bank/{id}', 'destroy')->name("atp.bank.delete");
    });

    Route::controller(AuditController::class)->group(function () {
        Route::get('/audit/main', 'main')->name("atp.audit.main");
        Route::get('/audit/maincreate/{id_mutasi}', 'maincreate')->name("atp.audit.main.create");
        Route::post('/audit/maincreate/{id_mutasi}', 'postcreate');
        Route::delete("/audit/gagalkan/{type}/{id_mutasi}", "destroyaudit")->name('atp.audit.destroy');
        Route::get('/audit/pengeluaran', 'pengeluaran')->name("atp.audit.pengeluaran");
        Route::get('/audit/pemasukan', 'pemasukan')->name("atp.audit.pemasukan");
    });

    Route::controller(DepositOtomaxController::class)->group(function(){
        Route::get("/deposit/otomax", "index")->name("atp.deposit.otomax");
        Route::get("/deposit/otomax/create", "create")->name("atp.deposit.otomax.create");
        Route::post("/deposit/otomax/create", "store");
        Route::get("/deposit/otomax/{id}/edit", "edit")->name('atp.deposit.otomax.edit');
        Route::put("/deposit/otomax/{id}", "update")->name('atp.deposit.otomax.update');
        Route::delete("/deposit/otomax/{id}", "destroy")->name('atp.deposit.otomax.destroy');
    });

    Route::controller(MonitoringDepositController::class)->group(function(){
        Route::get("/monitor/deposit/otomax", "index")->name("atp.monitoring.deposit");
    });
});

Route::middleware(["auth", "user-role:superuser|karyawan"])->group(function () {
    Route::controller(MutasiBankController::class)->group(function () {
        Route::get('/mutasi', 'index')->name("atp.mutasi");
        Route::get('/mutasi/detail/{id}', 'detail')->name("atp.bank.mutasi.detail");
        Route::get('/mutasi/create/{id_bank}/create', 'create')->name("atp.bank.mutasi.create");
        Route::post('/mutasi/create/{id_bank}', 'store')->name("atp.bank.mutasi.store");
        Route::delete('/mutasi/{id_bank}/delete/{id_mutasi}', 'destroy')->name("atp.bank.mutasi.delete");
    });

    Route::controller(MutasiModulController::class)->group(function () {
        Route::get('/modul/mutasi', 'index')->name("atp.modul.mutasi");
        Route::get('/modul/mutasi/detail/{id}', 'detail')->name("atp.modul.mutasi.detail");
        Route::get('/modul/mutasi/create/{id_modul}/create', 'create')->name("atp.modul.mutasi.create");
        Route::post('/modul/mutasi/store/{id_modul}', 'store')->name("atp.modul.mutasi.store");
        Route::get("/modul/mutasi/{id_monitor}/akhir", "update_akhir")->name("atp.modul.mutasi.akhir");
        Route::put('/modul/mutasi/{id_monitor}/akhir', "update_saldo_akhir");
    });

    Route::controller(DepositKreditController::class)->group(function(){
        Route::get("/deposit/kredit", "index")->name("atp.deposit.kredit");
        Route::get("/deposit/kredit/create", "create")->name("atp.deposit.kredit.create");
        Route::post("/deposit/kredit/create", "store");
        Route::get("/deposit/kredit/{id}/edit", "edit")->name('atp.deposit.kredit.edit');
        Route::put("/deposit/kredit/{id}", "update")->name('atp.deposit.kredit.update');
        Route::delete("/deposit/kredit/{id}", "destroy")->name('atp.deposit.kredit.destroy');
    });

});
