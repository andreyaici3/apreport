<x-app-layout menuActive="tiket">
    @section('breadcrumb')
        <div class="col-sm-6">
            <h1 class="m-0">HASIL</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Request Tiket</li>
            </ol>
        </div><!-- /.col -->
    @endsection
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <blockquote>Hasil Request Tiket Modul: <b>{{ $modul }}</b>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Detail</h3>
                    </div>
                    <div class="card-body">
                        @if ($result)
                            <h5 class="text-center">Silahkan Transfer</h5>
                            <h1 class="text-center">Rp. {{ number_format($nominal, 0, ',', '.') }} <a
                                    class="text-primary" id="copyNominal"><i class="far fa-copy"></i></a> </h1>
                            <div class="text-center">
                                <br>
                                <table class="table table-bordered">
                                    <tr>
                                        <td>Bank</td>
                                        <td>No Rekening</td>
                                    </tr>
                                    @if ($bri != null)
                                        <tr>
                                            <td><img width="100px" src="/dist/img/bri.png" alt=""></td>
                                            <td class="px-0 text-center">{{ $bri }} <a class="text-primary"
                                                    id="copyNominal"><i class="far fa-copy"></i></a></td>
                                        </tr>
                                    @endif

                                    <tr>
                                        <td><img width="100px" src="/dist/img/bca.png" alt=""></td>
                                        <td>{{ $bca }} <a class="text-primary" id="copyNominal"><i
                                                    class="far fa-copy"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td><img width="100px" src="/dist/img/bni.png" alt=""></td>
                                        <td>{{ $bni }} <a class="text-primary" id="copyNominal"><i
                                                    class="far fa-copy"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td><img width="100px" src="/dist/img/mandiri.png" alt=""></td>
                                        <td>{{ $mandiri }} <a class="text-primary" id="copyNominal"><i
                                                    class="far fa-copy"></i></a></td>
                                    </tr>
                                </table>
                            </div>
                            <h4 class="text-center">Atas Nama: <br><b>{{ $nama }}</b></h4>
                        @else
                            <h1 class="text-center">Request Tiket Gagal</h1>
                            <div class="text-center">
                                <a class="text-center btn btn-primary" href="">Kembali</a>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
