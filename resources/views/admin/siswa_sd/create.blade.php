@extends('template.main')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="/siswa-sd">Siswa SD</a></li>
    <li class="breadcrumb-item active" aria-current="page">Create</li>
    </ol>
</nav>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <p class="mb-0">Tambah Siswa</p>
        </div>
        <div class="card-body">
            <form action="{{ route('siswa-sd.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="nis" class="form-label">NIS</label>
                    <input type="text" class="form-control" id="nis" name="nis" required>
                </div>
                <div class="form-group">
                    <label for="tahun_masuk_sd">Tahun Masuk SD</label>
                    <select class="form-control" id="tahun_masuk_sd" name="tahun_masuk_sd">
                        @for ($tahun = 2000; $tahun <= 2060; $tahun++)
                            <option value="{{ $tahun }}" {{ old('tahun_masuk_sd') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                        @endfor
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
    
</div>
@endsection