<x-app-layout menuActive="modulMutasi">
    @section('breadcrumb')
        <div class="col-sm-6">
            <h1 class="m-0">DATA MONITOR MODUL {{ $modul->kode_bank }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Data Monitor Modul</li>
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
                                            <th>Saldo Awal</th>
                                            <th>Penambahan Saldo</th>
                                            <th>Saldo Akhir</th>
                                            <th>Pembelian Otomax</th>
                                            <th>Penjualan Otomax</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $nomor = 1;
                                        @endphp
                                        @foreach ($modul->monitor as $key => $value)
                                            <tr>
                                                <td>{{ $nomor++ }}</td>
                                                <td>{{ $value->tanggal }}</td>
                                                <td>Rp. {{ number_format($value->saldo_awal, 0, ',', '.') }}</td>
                                                <td>Rp. {{ number_format($value->penambahan_saldo, 0, ',', '.') }}</td>
                                                <td>Rp. {{ number_format($value->sisa_saldo, 0, ',', '.') }}</td>
                                                <td>Rp. {{ number_format($value->pembelian_oto, 0, ',', '.') }}</td>
                                                <td>Rp. {{ number_format($value->penjualan_oto, 0, ',', '.') }}</td>
                                                <td>
                                                    @if (($value->saldo_awal + $value->penambahan_saldo - $value->sisa_saldo) == $value->pembelian_oto )
                                                        <button type="button" class="btn btn-md btn-success btn-xs">
                                                            Aman
                                                        </button>
                                                    @else
                                                        @php
                                                            if ($value->pembelian_oto != 0){
                                                                if (($value->saldo_awal + $value->penambahan_saldo) - $value->sisa_saldo > $value->pembelian_oto){
                                                                    $sisa = (($value->saldo_awal + $value->penambahan_saldo) - $value->sisa_saldo) - $value->pembelian_oto;
                                                                } else {
                                                                    $sisa = ((($value->saldo_awal + $value->penambahan_saldo) - $value->sisa_saldo) - $value->pembelian_oto) * -1;
                                                                }
                                                                
                                                            } else {
                                                                $sisa = (($value->saldo_awal + $value->penambahan_saldo) - $value->sisa_saldo) * -1;
                                                            }
                                                        @endphp
                                                        @if ($sisa > 0)
                                                            <button type="button"
                                                                class="btn btn-md btn-primary btn-xs">
                                                                Rp. {{ number_format($sisa, 0, ',', '.') }}
                                                            </button>
                                                        @else
                                                            <button type="button" class="btn btn-md btn-danger btn-xs">
                                                                Rp. {{ number_format($sisa, 0, ',', '.') }}
                                                            </button>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>
                                                    <form id=""
                                                        action=""
                                                        style="display: inline-block;" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="button" data-id="{{ $value->id }}" onclick="hapus(this)" class="btn btn-xs btn-success">                                                            
                                                            Update
                                                        </button>
                                                    </form>|
                                                    <a href="{{ route('atp.modul.mutasi.akhir', ['id_monitor' => $value->id]) }}" class="btn btn-xs btn-primary">Saldo Akhir</a>
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

            function hapus(d) {
                Swal.fire({
                    title: "Konfirmasi",
                    text: "Yakin Ingin Menhapus Data",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        var id = d.getAttribute("data-id");
                        $("#delete" + id).submit();
                    }
                });
            }
        </script>
    @endsection

    @section('css')
        <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    @endsection

</x-app-layout>
