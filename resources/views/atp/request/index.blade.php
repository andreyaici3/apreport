<x-app-layout menuActive="tiket">
    @section('breadcrumb')
        <div class="col-sm-6">
            <h1 class="m-0">REQUEST TIKET</h1>
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
                        <blockquote>Result
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Pilih Modul</h3>
                    </div>

                    <form method="POST" action="{{ route('atp.req') }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="modul">Pilih Modul</label>
                                <select name="modul" class="form-control">
                                    <option value="0">- Pilih Deposit -</option>
                                    @foreach ($modul as $val)
                                        <option value="{{ $val->id }}">{{ $val->kode_modul }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="amount">Jumlah</label>
                                <input type="number" name="amount"
                                    class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" id="amount"
                                    placeholder="Masukan Amount" aria-describedby="amount-error" aria-invalid="false"
                                    value="{{ old('amount') ?? @$bank->amount }}">
                                <span id="amount-error" class="error invalid-feedback">
                                    {{ $errors->has('amount') ? '*) ' . $errors->first('amount') : '' }}</span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('atp.bank') }}" class="btn btn-danger float-right">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
