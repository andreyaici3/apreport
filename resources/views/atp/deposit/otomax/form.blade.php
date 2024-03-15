<div class="card-body">
    <div class="form-group">
        <label>Tanggal</label>
        <div class="input-group date" id="reservationdate" data-target-input="nearest">
            <input type="date" name="tanggal" class="form-control datetimepicker-input" data-target="#reservationdate"
                value="{{ date('Y-m-d') ?? @$otomax->tanggal }}" />
        </div>
    </div>
    <div class="form-group">
        <label for="nominal">Total Deposit RS</label>
        <input type="number" name="nominal" class="form-control {{ $errors->has('nominal') ? 'is-invalid' : '' }}"
            id="nominal" placeholder="Masukan nominal" aria-describedby="nominal-error" aria-invalid="false"
            value="{{ old('nominal') ?? @$otomax->nominal }}">
        <span id="nominal-error" class="error invalid-feedback">
            {{ $errors->has('nominal') ? '*) ' . $errors->first('nominal') : '' }}</span>
    </div>

    @if (Auth::user()->role == 'superuser')
        <div class="form-group">
            <label for="komisi">Total Komisi</label>
            <input type="number" name="komisi" class="form-control {{ $errors->has('komisi') ? 'is-invalid' : '' }}"
                id="komisi" placeholder="Masukan komisi" aria-describedby="komisi-error" aria-invalid="false"
                value="{{ old('komisi') ?? @$otomax->komisi }}">
            <span id="komisi-error" class="error invalid-feedback">
                {{ $errors->has('komisi') ? '*) ' . $errors->first('komisi') : '' }}</span>
        </div>

         <div class="form-group">
            <label for="laba">Total laba</label>
            <input type="number" name="laba" class="form-control {{ $errors->has('laba') ? 'is-invalid' : '' }}"
                id="laba" placeholder="Masukan laba" aria-describedby="laba-error" aria-invalid="false"
                value="{{ old('laba') ?? @$otomax->laba }}">
            <span id="laba-error" class="error invalid-feedback">
                {{ $errors->has('laba') ? '*) ' . $errors->first('laba') : '' }}</span>
        </div>
    @endif

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('atp.deposit.otomax') }}" class="btn btn-danger float-right">Cancel</a>
    </div>

</div>
