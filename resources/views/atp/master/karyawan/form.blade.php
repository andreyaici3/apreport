<div class="card-body">
    <div class="form-group">
        <label for="nama_lengkap">Nama Lengkap</label>
        <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
            id="nama_lengkap" placeholder="Masukan Nama Lengkap" aria-describedby="nama_lengkap-error" aria-invalid="false"
            value="{{ old('name') ?? @$user->name }}">
        <span id="nama_lengkap-error" class="error invalid-feedback">
            {{ $errors->has('name') ? '*) ' . $errors->first('name') : '' }}</span>
    </div>

    @if (!isset($user))
        <div class="form-group">
            <label for="email">Alamat Email</label>
            <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                id="email" placeholder="Masukan Alamat Email" aria-describedby="email-error" aria-invalid="false"
                value="{{ old('email') ?? @$user->email }}">
            <span id="email-error" class="error invalid-feedback">
                {{ $errors->has('email') ? '*) ' . $errors->first('email') : '' }}</span>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password"
                class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="password"
                placeholder="Password" aria-describedby="password-error" aria-invalid="false" value="">
            <span id="password-error" class="error invalid-feedback">
                {{ $errors->has('password') ? '*) ' . $errors->first('password') : '' }}</span>
        </div>
    @endif


</div>

<div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ route('atp.modul') }}" class="btn btn-danger float-right">Cancel</a>
</div>
