<div class="card-body">
    <div class="form-group">
        <label for="kode_bank">Kode Bank</label>
        <input {{ isset($bank) ? 'readonly' : '' }} type="text" name="kode_bank"
            class="form-control {{ $errors->has('kode_bank') ? 'is-invalid' : '' }}" id="kode_bank"
            placeholder="Masukan Kode Bank" aria-describedby="kode_bank-error" aria-invalid="false"
            value="{{ old('kode_bank') ?? @$bank->kode_bank }}">
        <span id="kode_bank-error" class="error invalid-feedback">
            {{ $errors->has('kode_bank') ? '*) ' . $errors->first('kode_bank') : '' }}</span>
    </div>

    <div class="form-group">
        <label>Tanggal</label>
        <div class="input-group date" id="reservationdate" data-target-input="nearest">
            <input type="date" name="tanggal" class="form-control datetimepicker-input" data-target="#reservationdate" value="{{ date('Y-m-d') }}" />
        </div>
    </div>
    <div class="form-group">
        <label for="amount">Jumlah</label>
        <input type="number" name="amount" class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}"
            id="amount" placeholder="Masukan Amount" aria-describedby="amount-error" aria-invalid="false"
            value="{{ old('amount') ?? @$bank->amount }}">
        <span id="amount-error" class="error invalid-feedback">
            {{ $errors->has('amount') ? '*) ' . $errors->first('amount') : '' }}</span>
    </div>

    <div class="form-group">
        <label for="tipe_mutasi">Tipe Mutasi</label>
        <div class="form-check">
            <input class="form-check-input {{ $errors->has('tipe_mutasi') ? 'is-invalid' : '' }}" type="radio"
                name="tipe_mutasi" value="credit">
            <label class="form-check-label">Credit</label>
        </div>
        <div class="form-check">
            <input class="form-check-input {{ $errors->has('tipe_mutasi') ? 'is-invalid' : '' }}" type="radio"
                name="tipe_mutasi" value="debit">
            <label class="form-check-label">Debit</label>
            <span id="tipe_mutasi-error" class="error invalid-feedback">
                {{ $errors->has('tipe_mutasi') ? '*) ' . $errors->first('tipe_mutasi') : '' }}</span>
        </div>

    </div>

    <div class="form-group">
        <label for="deposit_spl">Deposit Modul</label>
        <select name="deposit_spl" class="form-control">
            <option value="0">- Bukan Deposit Modul-</option>
            @foreach ($modul as $val)
                <option value="{{ $val->id }}">{{ $val->kode_modul }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="deposit_rs">Deposit Resseler</label>
        <div class="custom-control custom-checkbox">
            <input name="deposit_rs" class="custom-control-input" type="checkbox" id="customCheckbox1">
            <label for="customCheckbox1" class="custom-control-label">Ya</label>
        </div>
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('atp.bank') }}" class="btn btn-danger float-right">Cancel</a>
    </div>
</div>
