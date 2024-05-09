@extends('template.main')
@section('content')
<div class="container-fluid">
    <h1>Siswa TK</h1>
    <form action="{{ route('siswaTK.filter') }}" method="GET">
        <div class="form-group">
            <label for="tahun_masuk_tk">Tahun Masuk TK</label>
            <select class="form-control" id="tahun_masuk_tk" name="tahun_masuk_tk">
                @for ($tahun = 2000; $tahun <= 2060; $tahun++)
                    <option value="{{ $tahun }}">{{ $tahun }}</option>
                @endfor
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>
</div>
@endsection