@extends('template.main')
@section('content')
<div class="container-fluid">
    <h1>Siswa SD</h1>
    <form action="{{ route('siswaSD.filter') }}" method="GET">
        <div class="form-group">
            <label for="tahun_masuk_sd">Tahun Masuk SD</label>
            <select class="form-control" id="tahun_masuk_sd" name="tahun_masuk_sd">
                @for ($tahun = 2000; $tahun <= 2060; $tahun++)
                    <option value="{{ $tahun }}">{{ $tahun }}</option>
                @endfor
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>
</div>
@endsection
