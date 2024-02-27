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
    <div class="form-group">
        <label for="ipcenter">IP Center</label>
        <input type="text" name="ipcenter" class="form-control {{ $errors->has('ipcenter') ? 'is-invalid' : '' }}" id="ipcenter" placeholder="Masukan IP Ceneter" aria-describedby="ipcenter-error" aria-invalid="false" value="{{ old('ipcenter') ?? @$modul->ipcenter }}">
        <span id="ipcenter-error" class="error invalid-feedback">
            {{ $errors->has('ipcenter') ? '*) ' . $errors->first('ipcenter') : '' }}</span>
    </div>

    <div class="form-group">
        <label for="memberid">Member ID</label>
        <input type="text" name="memberid" class="form-control {{ $errors->has('memberid') ? 'is-invalid' : '' }}" id="memberid" placeholder="Masukan Member ID" aria-describedby="memberid-error" aria-invalid="false" value="{{ old('memberid') ?? @$modul->memberid }}">
        <span id="memberid-error" class="error invalid-feedback">
            {{ $errors->has('memberid') ? '*) ' . $errors->first('memberid') : '' }}</span>
    </div>

    <div class="form-group">
        <label for="pin">PIN</label>
        <input type="text" name="pin" class="form-control {{ $errors->has('pin') ? 'is-invalid' : '' }}" id="pin" placeholder="Masukan PIN Trx" aria-describedby="pin-error" aria-invalid="false" value="{{ old('pin') ?? @$modul->pin }}">
        <span id="pin-error" class="error invalid-feedback">
            {{ $errors->has('pin') ? '*) ' . $errors->first('pin') : '' }}</span>
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="text" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="password" placeholder="Masukan Password" aria-describedby="password-error" aria-invalid="false" value="{{ old('password') ?? @$modul->password }}">
        <span id="password-error" class="error invalid-feedback">
            {{ $errors->has('password') ? '*) ' . $errors->first('password') : '' }}</span>
    </div>

    <div class="form-group">
        <label>Format Request Tiket</label>
        <textarea class="form-control" placeholder="Masukan Format" name="format_request">{{ @$modul->format_request }}</textarea>
    </div>

    <div class="form-group">
        <label>Regex Penangkap Tiket</label>
        <textarea class="form-control" placeholder="Masukan Format" name="format_response">{{ @$modul->format_response }}</textarea>
    </div>

</div>

<div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ route('atp.modul') }}" class="btn btn-danger float-right">Cancel</a>
</div>