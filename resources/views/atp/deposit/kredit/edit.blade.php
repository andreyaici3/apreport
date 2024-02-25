<x-app-layout menuActive="kredit">
    @section('breadcrumb')
    <div class="col-sm-6">
        <h1 class="m-0">EDIT DEPOSIT / KREDIT</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('atp.deposit.kredit') }}">Data Deposit Kredit</a></li>
            <li class="breadcrumb-item active">Edit Deposit Kredit</li>
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

                    <form method="POST" action="{{ route('atp.deposit.kredit.update', ['id' => $kredit->id]) }}">
                        @csrf
                        @method('put')
                        @include('atp.deposit.kredit.form')
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>