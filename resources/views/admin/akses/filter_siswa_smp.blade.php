@extends('template.main')
@section('content')
<div class="container-fluid">
    <h1>Siswa SMP</h1>
    @if ($siswaSMPs->isEmpty())
        <p>Tidak ada data siswa.</p>
        <a class="btn btn-primary" href="{{ route('pilih-tahun-lulus-smp') }}">kembali</a>
    @else
        <form action="{{ route('siswaSMP.process') }}" method="POST">
            @csrf
            <div class="form-group">
                @foreach ($siswaSMPs as $siswaSMP)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="siswa_ids[]" value="{{ $siswaSMP->id }}">
                        <label class="form-check-label" for="siswa_{{ $siswaSMP->id }}">
                            {{ $siswaSMP->user->name }} ({{ $siswaSMP->nis }})
                        </label>
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-success">Proses</button>
        </form>
    @endif
</div>
@endsection
