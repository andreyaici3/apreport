<x-app-layout menuActive="monitorsaldo">

    @section('breadcrumb')
        <div class="col-sm-6">
            <h1 class="m-0">DATA MONITOR SALDO</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Data Deposit Otomax</li>
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
                                            @foreach ($bank as $bk)
                                                <th>{{ $bk->kode_bank }}</th>
                                            @endforeach
                                            <th>KREDIT</th>
                                            <th>Deposit RS</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $nomor = 1;
                                        @endphp
                                        @foreach ($mutasi as $key => $value)
                                            @php
                                                $total = 0;
                                            @endphp
                                            <tr>
                                                <td>{{ $nomor++ }}</td>
                                                <td>{{ date('d-m-Y', strtotime($value->tanggal)) }}</td>
                                                @foreach ($bank as $bk)
                                                    @php
                                                        $amount = $value->mutasibank
                                                            ->where('id_bank', $bk->id)
                                                            ->where('deposit_rs', 1)
                                                            ->sum('amount');
                                                        $total = $total + $amount;
                                                    @endphp
                                                    <td>Rp.
                                                        {{ number_format($value->mutasibank->where('id_bank', $bk->id)->where('deposit_rs', 1)->sum('amount'),0,',','.') }}
                                                    </td>
                                                @endforeach
                                                <td>Rp.
                                                    {{ number_format($value->deposit_kredit->sum('nominal'), 0, ',', '.') }}
                                                </td>
                                                <td>Rp. {{ number_format($value->nominal, 0, ',', '.') }}</td>
                                                <td>
                                                    @php
                                                        $total = $total + $value->deposit_kredit->sum('nominal');
                                                        $sisa = $total - $value->nominal;
                                                    @endphp
                                                    @if ($sisa == 0)
                                                        <button type="button" class="btn btn-md btn-success btn-xs">
                                                            Aman
                                                        </button>
                                                    @elseif($sisa > 0)
                                                        <button type="button" class="btn btn-md btn-primary btn-xs">
                                                            Rp. {{ number_format($sisa, 0, ',', '.') }}
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-md btn-danger btn-xs">
                                                            Rp. {{ number_format($sisa, 0, ',', '.') }}
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

        <script>
            $(function() {
                $("#example1").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            });
        </script>
    @endsection

    @section('css')
        <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    @endsection

</x-app-layout>
