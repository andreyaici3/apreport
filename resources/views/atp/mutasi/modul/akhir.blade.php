<x-app-layout menuActive="modulMutasi">
    @section('breadcrumb')
        <div class="col-sm-6">
            <h1 class="m-0">INPUT SALDO AKHIR {{ strtoupper($monitor->modul->nama_modul) }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a
                        href="{{ route('atp.modul.mutasi.detail', ['id' => $monitor->id_modul]) }}">Monitor Modul</a></li>
                <li class="breadcrumb-item active">Input</li>
            </ol>
        </div><!-- /.col -->
    @endsection

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Mohon Isi Data Dengan Benar</h3>
                    </div>

                    <form method="POST" action="{{ route('atp.modul.mutasi.akhir', ['id_monitor' => $monitor->id]) }}">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="tanggal">Kode Modul</label>
                                <input readonly type="text" name="kode_modul"
                                    class="form-control {{ $errors->has('kode_modul') ? 'is-invalid' : '' }}"
                                    id="kode_modul" placeholder="Masukan Kode Modul" aria-describedby="kode_modul-error"
                                    aria-invalid="false"
                                    value="{{ old('kode_modul') ?? @$monitor->modul->kode_modul }}">
                                <span id="kode_modul-error" class="error invalid-feedback">
                                    {{ $errors->has('kode_modul') ? '*) ' . $errors->first('kode_modul') : '' }}</span>
                            </div>
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input readonly type="text" name="tanggal"
                                    class="form-control {{ $errors->has('tanggal') ? 'is-invalid' : '' }}"
                                    id="tanggal" placeholder="Masukan Tanggal" aria-describedby="tanggal-error"
                                    aria-invalid="false"
                                    value="{{ old('tanggal') ?? date('d-m-Y', strtotime(@$monitor->tanggal)) }}">
                                <span id="tanggal-error" class="error invalid-feedback">
                                    {{ $errors->has('tanggal') ? '*) ' . $errors->first('tanggal') : '' }}</span>
                            </div>
                            <div class="form-group">
                                <label for="saldo_akhir">Jumlah Saldo Akhir</label>
                                <input type="number" name="saldo_akhir"
                                    class="form-control {{ $errors->has('saldo_akhir') ? 'is-invalid' : '' }}"
                                    id="saldo_akhir" placeholder="Masukan Jumlah Saldo Akhir"
                                    aria-describedby="saldo_akhir-error" aria-invalid="false"
                                    value="{{ old('saldo_akhir') ?? @$monitor->sisa_saldo }}">
                                <span id="saldo_akhir-error" class="error invalid-feedback">
                                    {{ $errors->has('saldo_akhir') ? '*) ' . $errors->first('saldo_akhir') : '' }}</span>
                            </div>

                            @if (Auth::user()->role == 'superuser')
                                <div class="form-group">
                                    <label for="pembelian_otomax">Jumlah Pembelian Otomax</label>
                                    <input type="number" name="pembelian_otomax"
                                        class="form-control {{ $errors->has('pembelian_otomax') ? 'is-invalid' : '' }}"
                                        id="pembelian_otomax" placeholder="Masukan Jumlah Pembelian Otomax"
                                        aria-describedby="pembelian_otomax-error" aria-invalid="false"
                                        value="{{ old('pembelian_otomax') ?? @$monitor->pembelian_oto }}">
                                    <span id="pembelian_otomax-error" class="error invalid-feedback">
                                        {{ $errors->has('pembelian_otomax') ? '*) ' . $errors->first('pembelian_otomax') : '' }}</span>
                                </div>

                                <div class="form-group">
                                    <label for="penjualan_oto">Jumlah Penjualan Otomax</label>
                                    <input type="number" name="penjualan_otomax"
                                        class="form-control {{ $errors->has('penjualan_oto') ? 'is-invalid' : '' }}"
                                        id="penjualan_oto" placeholder="Masukan Jumlah Penjualan Otomax"
                                        aria-describedby="penjualan_oto-error" aria-invalid="false"
                                        value="{{ old('penjualan_oto') ?? @$monitor->penjualan_oto }}">
                                    <span id="penjualan_oto-error" class="error invalid-feedback">
                                        {{ $errors->has('penjualan_oto') ? '*) ' . $errors->first('penjualan_oto') : '' }}</span>
                                </div>
                            @endif
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('atp.modul.mutasi.detail', ['id' => $monitor->id_modul]) }}"
                                class="btn btn-danger float-right">Cancel</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
