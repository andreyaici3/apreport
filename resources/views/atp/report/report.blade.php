<x-app-layout menuActive="report">

    @section('breadcrumb')
        <div class="col-sm-6">
            <h1 class="m-0">Report Bulan Juni 2024</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Report</li>
            </ol>
        </div><!-- /.col -->
    @endsection

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-12">
                                @if (Session::has('sukses'))
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-hidden="true">×</button>
                                        <h5><i class="icon fas fa-check"></i> Selamat!</h5>
                                        {{ session('sukses') }}
                                    </div>
                                @endif

                                @if (Session::has('gagal'))
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-hidden="true">×</button>
                                        <h5><i class="icon fas fa-ban"></i> Oopss!</h5>
                                        {{ session('gagal') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Pembelian Modul</th>
                                            <th>Penjualan Modul</th>
                                            <th>Laba Kotor</th>
                                            <th>Komisi</th>
                                            <th>Laba Bersih</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $nomor = 1;
                                        @endphp
                                        @foreach ($rep as $key => $value)
                                            @php
                                                $pembelian = $value->monitor_modul->sum('pembelian_oto');
                                                $penjualan = $value->monitor_modul->sum('penjualan_oto');
                                                $labaKotor = $penjualan - $pembelian;
                                                $komisi = $value->komisi;
                                                $lababersih = $value->laba;
                                                $lababersihperhitungan = $labaKotor - $komisi;
                                            @endphp
                                            <tr>
                                                <td>{{ $nomor++ }}</td>
                                                <td>{{ date('d-m-Y', strtotime($value->tanggal)) }}</td>
                                                <td>Rp. {{ number_format($pembelian, 0, ',', '.') }}</td>
                                                <td>Rp. {{ number_format($penjualan, 0, ',', '.') }}</td>
                                                <td>Rp. {{ number_format($labaKotor, 0, ',', '.') }}</td>
                                                <td>Rp. {{ number_format($komisi, 0, ',', '.') }}</td>
                                                <td>Rp. {{ number_format($lababersih, 0, ',', '.') }}</td>
                                                <td>
                                                    @if ($lababersihperhitungan == $lababersih)
                                                        <button type="button" class="btn btn-md btn-success btn-xs">
                                                            Aman
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('js')
        <script src="/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="/plugins/jszip/jszip.min.js"></script>
        <script src="/plugins/pdfmake/pdfmake.min.js"></script>
        <script src="/plugins/pdfmake/vfs_fonts.js"></script>
        <script src="/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="/plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="/plugins/daterangepicker/daterangepicker.js"></script>

        <script>
            $(function() {
                $("#example1").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                //Date picker


            });
        </script>
    @endsection

    @section('css')
        <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
        <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
    @endsection

</x-app-layout>
