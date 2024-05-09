@extends('template.main')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Siswa SMP</li>
        </ol>
    </nav>
    
    <div class="container-fluid">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
        @endif
        @if (session('successupdate'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('successupdate') }}
        </div>
        @endif
        @if (session('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('delete') }}
        </div>
        @endif
        <div class="card">
            <div class="card-body">
                <!-- Form Pencarian -->
                
                <div class="d-flex justify-content-between mb-3">
                    <form class="form-inline" action="{{ route('siswa-smp.index') }}" method="GET">
                        <input type="text" name="search" class="form-control mr-sm-2" placeholder="Search..." value="{{ request()->input('search') }}">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                    <a class="btn btn-outline-primary" href="{{ route('siswa-smp.create') }}">tambah siswa</a>
                </div>                
                <table  class="table datatable table-hover table-bordered">
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
                            <td>{{ $siswa->tahun_masuk_smp }}</td>
                            @if ($siswa->status == 1)
                            <td>Masih Sekolah</td>
                            @else
                            <td>Alumni</td>
                            @endif
                            <td><a href="{{ route('rapot.show', ['rapot' => $siswa->nis]) }}">lihat rapot</a></td>
                        <td>
                            <a class="btn btn-info" href="{{ route('siswa-smp.show', ['siswa_smp' => $siswa->nis]) }}"><i class="fas fa-fw fa-eye"></i></a>
                            <a class="btn btn-primary" href="{{ route('siswa-smp.edit', ['siswa_smp' => $siswa->nis]) }}"><i class="fas fa-fw fa-edit"></i> Edit</a>
                                    <form action="{{ route('siswa-smp.destroy', ['siswa_smp' => $siswa->user->id]) }}" method="POST" style="display: inline-block;">
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