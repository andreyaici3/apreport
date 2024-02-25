<x-app-layout menuActive="karyawan">
    @section('breadcrumb')
        <div class="col-sm-6">
            <h1 class="m-0">EDIT KARYAWAN</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('atp.karyawan') }}">Data Karyawan</a></li>
                <li class="breadcrumb-item active">Edit Karyawan</li>
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

                    <form method="POST" action="{{ route('atp.karyawan.update', ['id' => $user->id]) }}">
                        @csrf
                        @method('PUT')
                        @include('atp.master.karyawan.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
