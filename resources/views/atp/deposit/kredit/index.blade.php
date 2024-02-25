<x-app-layout menuActive="kredit">

    @section('breadcrumb')
    <div class="col-sm-6">
        <h1 class="m-0">DATA DEPOSIT</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Data Deposit Kredit</li>
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
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-check"></i> Selamat!</h5>
                                    {{ session('sukses') }}
                                </div>
                                @endif

                                @if (Session::has('gagal'))
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
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
                                            <th>ID Agen</th>
                                            <th>Nominal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $nomor = 1;
                                        @endphp
                                        @foreach ($kredit as $key => $value)
                                        <tr>
                                            <td>{{ $nomor++ }}</td>
                                            <td>{{ date('d-m-Y', strtotime($value->tanggal)) }}</td>
                                            <td>{{ $value->id_agen }}</td>
                                            <td>Rp. {{ number_format($value->nominal, 0, ',', '.') }}</td>
                                            <td>
                                                <a href="{{ route('atp.deposit.kredit.edit', ['id' => $value->id]) }}" class="btn btn-xs btn-primary">
                                                    <i class="fas fa-edit"></i>
                                                    Edit
                                                </a>|
                                                <form id="delete{{ $value->id }}" action="{{ route('atp.deposit.kredit.destroy', ['id' => $value->id]) }}" style="display: inline-block;" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" data-id="{{ $value->id }}" onclick="hapus(this)" class="btn btn-xs btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                        Hapus
                                                    </button>
                                                </form>

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
        <div class="row mt-1">
            <div class="col-3">
                <a href="{{ route('atp.deposit.kredit.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>
                    DEPOSIT KREDIT</a>
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
                text: "Yakin Ingin Menghapus Data.?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Hapus"
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