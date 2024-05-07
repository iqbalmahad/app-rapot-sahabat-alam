@extends('template.main')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Siswa TK</li>
    </ol>
</nav>
<div class="container-fluid">
    
<div class="card">
    <div class="card-body">
        <!-- Form Pencarian -->
        <div class="d-flex justify-content-between mb-3">
            <form class="form-inline" action="{{ route('siswa-tk.index') }}" method="GET">
                <input type="text" name="search" class="form-control mr-sm-2" placeholder="Search..." value="{{ request()->input('search') }}">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
            <a class="btn btn-outline-primary" href="{{ route('siswa-tk.create') }}">tambah siswa</a>
        </div>
        <table id="datatables" class="table datatable table-hover table-bordered">
            <thead>
            <tr>
                <th>NIS</th>
                <th>Nama</th>
                <th>Tahun Masuk</th>
                <th>Status</th>
                <th>Rapot</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            
            @foreach ($siswas as $siswa)
            
            <tr>
                <td>{{ $siswa->nis }}</td>
                <td>{{ $siswa->user->name }}</td>
                <td>{{ $siswa->tahun_masuk_tk }}</td>
                    @if ($siswa->status == 1)
                    <td>Masih Sekolah</td>
                    @else
                    <td>Alumni</td>
                    @endif
                <td><a href="{{ route('rapot.show', ['rapot' => $siswa->nis]) }}">lihat rapot</a></td>
                <td>
                    <a class="btn btn-info" href="{{ route('siswa-tk.show', ['siswa_tk' => $siswa->nis]) }}"><i class="fas fa-fw fa-eye"></i></a>
                    <a class="btn btn-primary" href="{{ route('siswa-tk.edit', ['siswa_tk' => $siswa->nis]) }}"><i class="fas fa-fw fa-edit"></i> Edit</a>
                            <form action="{{ route('siswa-tk.destroy', ['siswa_tk' => $siswa->user->id]) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus siswa ini?')"><i class="fas fa-fw fa-trash"></i> Hapus</button>
                            </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-4">
            {{ $siswas->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
</div>
@endsection