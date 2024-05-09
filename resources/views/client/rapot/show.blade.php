@extends('template.main')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Rapot</li>
    </ol>
</nav>
<div class="container-fluid">
    <div class="row">
    @foreach ($rapots as $rapot)
        <div class="col col-md-4 mb-3">
            <div class="card">
                <div class="card-header bg-primary text-white font-weight-bold">
                    Rapot Kelas {{ $rapot->tingkatan_kelas }}
                </div>
                <div class="card-body">
                    <h5 class="card-title">Nama: {{ $siswa->user->name }}</h5>
                    <p class="card-text">semester: {{ $rapot->semester }}</p>
                    <hr>
                    <p class="card-text text-center font-weight-bold"><a href="{{ $rapot->rapot }}">Download Rapot</a></p>
                    
                </div>
            </div>    
        </div>  
    @endforeach
    </div>    
</div>
@endsection
