@extends('template.main')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="/siswa-sd">Siswa SD</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit</li>
    </ol>
</nav>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('siswa-sd.update', $siswa->id) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $siswa->user->name) }}">
                </div>

                <div class="form-group">
                    <label for="nis">NIS</label>
                    <input type="text" class="form-control" id="nis" name="nis" value="{{ old('nis', $siswa->nis) }}">
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="0" {{ old('status', $siswa->status) == '0' ? 'selected' : '' }}>Alumni</option>
                        <option value="1" {{ old('status', $siswa->status) == '1' ? 'selected' : '' }}>Masih Sekolah</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="tahun_masuk_sd">Tahun Masuk SD</label>
                    <select class="form-control" id="tahun_masuk_sd" name="tahun_masuk_sd">
                        @for ($tahun = 2000; $tahun <= 2060; $tahun++)
                            <option value="{{ $tahun }}" {{ old('tahun_masuk_sd', $siswa->tahun_masuk_sd) == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                        @endfor
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Perbarui</button>
            </form>
        </div>
    </div>
</div>
@endsection