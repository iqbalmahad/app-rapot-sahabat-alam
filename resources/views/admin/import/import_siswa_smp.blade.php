@extends('template.main')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Import Siswa SMP</li>
    </ol>
</nav>

<div class="container-fluid">
    @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Import Data Siswa SMP</h5>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="alert-info p-2 mb-2">
                Pastikan file yang Anda unggah memiliki format Excel (.xlsx atau .xls) dan mengikuti struktur data yang sesuai:
                <ul>
                    <li>Nama siswa: teks dengan panjang maksimal 255 karakter.</li>
                    <li>NIS (Nomor Induk Siswa): teks dengan panjang maksimal 20 karakter, harus unik.</li>
                    <li>Tahun Masuk SMP: format tahun (misalnya "2022", "2023", dll).</li>
                </ul>
            </div>

            <form action="{{ route('siswa-smp.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="file" class="form-label">Upload File Excel</label>
                    <input type="file" class="form-control" id="file" name="file" accept=".xlsx, .xls">
                </div>
                <button type="submit" class="btn btn-primary">Import</button>
            </form>
        </div>
    </div>
</div>
@endsection
