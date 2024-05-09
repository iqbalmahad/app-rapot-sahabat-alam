@extends('template.main')
@section('content')
<div class="container-fluid">
    <h1>Siswa TK</h1>
    @if ($siswaTKs->isEmpty())
        <p>Tidak ada data siswa.</p>
        <a class="btn btn-primary" href="{{ route('pilih-tahun-lulus-tk') }}">kembali</a>
    @else
        <form action="{{ route('siswaTK.process') }}" method="POST">
            @csrf
            <div class="form-group">
                @foreach ($siswaTKs as $siswaTK)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="siswa_ids[]" value="{{ $siswaTK->id }}">
                        <label class="form-check-label" for="siswa_{{ $siswaTK->id }}">
                            {{ $siswaTK->user->name }} ({{ $siswaTK->nis }})
                        </label>
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-success">Proses</button>
        </form>
    @endif
</div>
@endsection