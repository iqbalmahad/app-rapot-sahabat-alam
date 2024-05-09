@extends('template.main')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Rapot</li>
    </ol>
</nav>
<div class="container-fluid">
    
<div class="card mb-3">
    <div class="card-header bg-success text-white">
        <p class="mb-0">
            Rapot {{ $siswa->user->name }}
        </p>
        
    </div>
    
    <div class="card-body">
        <p>
            belum memiliki rapot
        </p>
        <!-- Form Pencarian -->
        <div class="d-flex justify-content-between mb-3">
            <a class="btn btn-outline-primary" href="{{ route('rapot.create') }}">tambah rapot</a>
        </div>
    </div>
</div>
</div>
@endsection