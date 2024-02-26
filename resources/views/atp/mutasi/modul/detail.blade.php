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
                                        @foreach ($dep as $key => $value)
                                            @php
                                                $sd = $value->monitor_modul->where('id_modul', $id)->first();
                                                $saldo_awal = $sd->saldo_awal ?? 0;
                                                $penambahan_saldo = $sd->penambahan_saldo ?? 0;
                                                $sisa_saldo = $sd->sisa_saldo ?? 0;
                                                $pembelian_oto = $sd->pembelian_oto ?? 0;
                                                $penjualan_oto = $sd->penjualan_oto ?? 0;
                                                $result = $sd;
                                            @endphp
                                            <tr>
                                                <td>{{ $nomor++ }}</td>
                                                <td>{{ date('d-m-Y', strtotime($value->tanggal)) }}</td>
                                                <td>Rp.
                                                    {{ number_format($saldo_awal, 0, ',', '.') }}
                                                </td>
                                                <td>Rp.
                                                    {{ number_format($penambahan_saldo, 0, ',', '.') }}
                                                </td>
                                                <td>Rp.
                                                    {{ number_format($sisa_saldo, 0, ',', '.') }}
                                                </td>
                                                <td>Rp.
                                                    {{ number_format($pembelian_oto, 0, ',', '.') }}
                                                </td>
                                                <td>Rp.
                                                    {{ number_format($penjualan_oto, 0, ',', '.') }}
                                                </td>
                                                <td>
                                                    @if ($saldo_awal + $penambahan_saldo - $sisa_saldo == $pembelian_oto)
                                                        <button type="button" class="btn btn-md btn-success btn-xs">
                                                            Aman
                                                        </button>
                                                    @else
                                                        @php
                                                            if ($pembelian_oto != 0) {
                                                                if ($saldo_awal + $penambahan_saldo - $sisa_saldo > $pembelian_oto) {
                                                                    $sisa = $saldo_awal + $penambahan_saldo - $sisa_saldo - $pembelian_oto;
                                                                } else {
                                                                    $sisa = ($saldo_awal + $penambahan_saldo - $sisa_saldo - $pembelian_oto) * -1;
                                                                }
                                                            } else {
                                                                $sisa = ($saldo_awal + $penambahan_saldo - $sisa_saldo) * -1;
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
                                                    @if ($result != null)
                                                        <form id="delete{{ $sd->id }}" action="{{ route('atp.modul.mutasi.sync', ['tanggal' => $value->tanggal, 'id_modul' => $id]) }}"
                                                            style="display: inline-block;" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="button" data-id="{{ $sd->id }}"
                                                                onclick="hapus(this)" class="btn btn-xs btn-success">
                                                                Sync Saldo Awal
                                                            </button>
                                                        </form>|
                                                        <a href="{{ route('atp.modul.mutasi.akhir', ['id_monitor' => $sd->id]) }}"
                                                            class="btn btn-xs btn-primary">Input Sisa Saldo</a>
                                                    @else
                                                        <a href="{{ route('atp.modul.mutasi.createmonitor', ['id_modul' => $id, 'tanggal' => $value->tanggal]) }}"
                                                            class="btn btn-xs btn-info">Buat Monitor</a>
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

            function hapus(d) {
                Swal.fire({
                    title: "Konfirmasi",
                    text: "Yakin Ingin Synsc Saldo Awal",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes"
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
