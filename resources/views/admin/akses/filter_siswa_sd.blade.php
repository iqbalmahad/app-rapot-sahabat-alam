@extends('template.main')
@section('content')
<div class="container-fluid">
    <h1>Siswa SD</h1>
    @if ($siswaSDs->isEmpty())
        <p>Tidak ada data siswa.</p>
        <a class="btn btn-primary" href="{{ route('pilih-tahun-lulus-sd') }}">kembali</a>
    @else
        <form action="{{ route('siswaSD.process') }}" method="POST">
            @csrf
            <div class="form-group">
                @foreach ($siswaSDs as $siswaSD)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="siswa_ids[]" value="{{ $siswaSD->id }}">
                        <label class="form-check-label" for="siswa_{{ $siswaSD->id }}">
                            {{ $siswaSD->user->name }} ({{ $siswaSD->nis }})
                        </label>
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-success">Proses</button>
        </form>
    @endif
</div>
@endsection
