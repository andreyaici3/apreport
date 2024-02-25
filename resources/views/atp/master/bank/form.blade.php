<div class="card-body">
    <div class="form-group">
        <label for="kode_bank">Kode Bank</label>
        <input {{ (isset($bank)) ? "readonly" : "" }} type="text" name="kode_bank" class="form-control {{ $errors->has('kode_bank') ? 'is-invalid' : '' }}" id="kode_bank" placeholder="Masukan Kode Bank" aria-describedby="kode_bank-error" aria-invalid="false" value="{{ old('kode_bank') ?? @$bank->kode_bank }}">
        <span id="kode_bank-error" class="error invalid-feedback">
            {{ $errors->has('kode_bank') ? '*) ' . $errors->first('kode_bank') : '' }}</span>
    </div>
    <div class="form-group">
        <label for="nama_bank">Nama Bank</label>
        <input type="text" name="nama_bank" class="form-control {{ $errors->has('nama_bank') ? 'is-invalid' : '' }}" id="nama_bank" placeholder="Masukan Nama Bank" aria-describedby="nama_bank-error" aria-invalid="false" value="{{ old('nama_bank') ?? @$bank->nama_bank }}">
        <span id="nama_bank-error" class="error invalid-feedback">
            {{ $errors->has('nama_bank') ? '*) ' . $errors->first('nama_bank') : '' }}</span>
    </div>

    <div class="form-group">
        <label for="norek">No Rekening</label>
        <input type="number" name="norek" class="form-control {{ $errors->has('norek') ? 'is-invalid' : '' }}" id="norek" placeholder="Masukan No Rekening" aria-describedby="norek-error" aria-invalid="false" value="{{ old('norek') ?? @$bank->norek }}">
        <span id="norek-error" class="error invalid-feedback">
            {{ $errors->has('norek') ? '*) ' . $errors->first('norek') : '' }}</span>
    </div>

</div>

<div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ route('atp.bank') }}" class="btn btn-danger float-right">Cancel</a>
</div>