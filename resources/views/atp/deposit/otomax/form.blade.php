<div class="card-body">
    <div class="form-group">
        <label>Tanggal</label>
        <div class="input-group date" id="reservationdate" data-target-input="nearest">
            <input type="date" name="tanggal" class="form-control datetimepicker-input" data-target="#reservationdate"
                value="{{ date('Y-m-d') ?? @$otomax->tanggal}}" />
        </div>
    </div>
    <div class="form-group">
        <label for="nominal">Jumlah</label>
        <input type="number" name="nominal" class="form-control {{ $errors->has('nominal') ? 'is-invalid' : '' }}"
            id="nominal" placeholder="Masukan nominal" aria-describedby="nominal-error" aria-invalid="false"
            value="{{ old('nominal') ?? @$otomax->nominal }}">
        <span id="nominal-error" class="error invalid-feedback">
            {{ $errors->has('nominal') ? '*) ' . $errors->first('nominal') : '' }}</span>
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('atp.deposit.otomax') }}" class="btn btn-danger float-right">Cancel</a>
    </div>

</div>
