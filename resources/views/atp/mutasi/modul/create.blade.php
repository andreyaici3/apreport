<x-app-layout menuActive="modulMutasi">
    @section('breadcrumb')
    <div class="col-sm-6">
        <h1 class="m-0">TAMBAH MONITOR MODUL {{ $modul->nama_modul }}</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('atp.bank') }}">Data bank</a></li>
            <li class="breadcrumb-item active">Tambah bank</li>
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

                    <form method="POST" action="{{ route('atp.modul.mutasi.store', ['id_modul' => $modul->id]) }}">
                        @csrf
                        @include('atp.mutasi.modul.form')
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>