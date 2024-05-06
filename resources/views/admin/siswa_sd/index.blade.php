@extends('template.main')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Siswa SD</li>
    </ol>
</nav>
<div class="container-fluid">

<div class="card">
    <div class="card-body">
        <!-- Form Pencarian -->
        {{-- {{ route('students.inschool') }} nanti taruh di action --}}
        <form action="/" method="GET">
            <input type="text"  name="search" placeholder="Search..." value="{{ request()->input('search') }}">
            <button type="submit" class="mb-3 text-white bg-primary border-0">Search</button>
        </form>
        <table  class="table datatable table-hover table-bordered">
            <thead>
            <tr>
                <th>NIS</th>
                <th>Nama</th>
                <th>Tahun Masuk</th>
                <th>Rapot</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            
            @foreach ($siswas as $siswa)
            
            <tr>
                <td>{{ $siswa->nis }}</td>
                <td>{{ $siswa->user->name }}</td>
                <td>{{ $siswa->tahun_masuk_sd }}</td>
                <td>rapot</td>
                <td>
                    <a class="btn btn-info" href="{{ route('siswa-sd.show', ['siswa_sd' => $siswa->nis]) }}"><i class="fas fa-fw fa-eye"></i></a>
                    <a class="btn btn-primary" href="{{ route('siswa-sd.edit', ['siswa_sd' => $siswa->nis]) }}"><i class="fas fa-fw fa-edit"></i> Edit</a>
                            <form action="{{ route('siswa-sd.destroy', ['siswa_sd' => $siswa->user->id]) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus siswa ini?')"><i class="fas fa-fw fa-trash"></i> Hapus</button>
                            </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
@endsection