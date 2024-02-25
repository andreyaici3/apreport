<div class="card-body">
    <div class="form-group">
        <label for="kode_modul">Kode Modul</label>
        <input type="text" name="kode_modul" class="form-control {{ $errors->has('kode_modul') ? 'is-invalid' : '' }}" id="kode_modul" placeholder="Masukan kode Modul" aria-describedby="kode_modul-error" aria-invalid="false" value="{{ old('kode_modul') ?? @$modul->kode_modul }}">
        <span id="kode_modul-error" class="error invalid-feedback">
            {{ $errors->has('kode_modul') ? '*) ' . $errors->first('kode_modul') : '' }}</span>
    </div>
    <div class="form-group">
        <label for="nama_modul">Nama Modul</label>
        <input type="text" name="nama_modul" class="form-control {{ $errors->has('nama_modul') ? 'is-invalid' : '' }}" id="nama_modul" placeholder="Masukan Nama Modul" aria-describedby="nama_modul-error" aria-invalid="false" value="{{ old('nama_modul') ?? @$modul->nama_modul }}">
        <span id="nama_modul-error" class="error invalid-feedback">
            {{ $errors->has('nama_modul') ? '*) ' . $errors->first('nama_modul') : '' }}</span>
    </div>

</div>

<div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ route('atp.modul') }}" class="btn btn-danger float-right">Cancel</a>
</div>