<div class="card-body">
    <div class="form-group">
        <label for="tanggal">Tanggal</label>
        <input type="text" name="name" class="form-control {{ $errors->has('tanggal') ? 'is-invalid' : '' }}"
            id="tanggal" placeholder="Masukan Nama Lengkap" aria-describedby="tanggal-error" aria-invalid="false"
            value="{{ old('tanggal') ?? date('d-m-Y', strtotime(@$mutasi->tanggal)) }}" readonly>
        <span id="tanggal-error" class="error invalid-feedback">
            {{ $errors->has('tanggal') ? '*) ' . $errors->first('tanggal') : '' }}</span>
    </div>

    <div class="form-group">
        <label for="nominal">Nominal</label>
        <input type="text" name="name" class="form-control {{ $errors->has('nominal') ? 'is-invalid' : '' }}"
            id="nominal" placeholder="Masukan Nama Lengkap" aria-describedby="nominal-error" aria-invalid="false"
            value="{{ old('nominal') ?? @$mutasi->amount }}" readonly>
        <span id="nominal-error" class="error invalid-feedback">
            {{ $errors->has('nominal') ? '*) ' . $errors->first('nominal') : '' }}</span>
    </div>

    <div class="form-group">
        <label for="bank">Bank</label>
        <input type="text" name="name" class="form-control {{ $errors->has('bank') ? 'is-invalid' : '' }}"
            id="bank" placeholder="Masukan Nama Lengkap" aria-describedby="bank-error" aria-invalid="false"
            value="{{ old('bank') ?? @$mutasi->bank->nama_bank }}" readonly>
        <span id="bank-error" class="error invalid-feedback">
            {{ $errors->has('bank') ? '*) ' . $errors->first('bank') : '' }}</span>
    </div>

    <div class="form-group">
        <label for="audit_detail">Pemasukan Dari</label>
        <select name="audit_detail" class="form-control  {{ $errors->has('audit_detail') ? 'is-invalid' : '' }}">
            @foreach ($audit as $val)
                <option value="{{ $val->id }}">{{ $val->name }}</option>
            @endforeach
        </select>
        <span id="audit_detail-error" class="error invalid-feedback">
            {{ $errors->has('name') ? '*) ' . $errors->first('name') : '' }}</span>
    </div>

    <div class="form-group">
        <label for="catatan">Catatan</label>
        <input type="text" name="catatan" class="form-control {{ $errors->has('catatan') ? 'is-invalid' : '' }}"
            id="catatan" placeholder="Masukan Keterangan Tambahan" aria-describedby="catatan-error"
            aria-invalid="false" value="{{ old('catatan') ?? @$mutasi->keterangan }}">
        <span id="catatan-error" class="error invalid-feedback">
            {{ $errors->has('catatan') ? '*) ' . $errors->first('catatan') : '' }}</span>
    </div>
</div>

<div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ route('atp.audit.main') }}" class="btn btn-danger float-right">Cancel</a>
</div>
