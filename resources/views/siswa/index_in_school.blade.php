@extends('template.main')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="pagetitle">
        <h1>Siswa Masih Sekolah</h1>
    </div>

    
<div class="card">
    <div class="card-body">
        <!-- Form Pencarian -->
        <form action="{{ route('students.inschool') }}" method="GET">
            <input type="text"  name="search" placeholder="Search..." value="{{ request()->input('search') }}">
            <button type="submit" class="mb-3 text-white bg-primary border-0">Search</button>
        </form>
        {{-- <a href="{{ route('students.create') }}" class="btn btn-success mb-3">Tambah Siswa</a> --}}
        <table  class="table datatable table-hover table-bordered">
            <thead>
            <tr>
                <th>NIS</th>
                <th>Nama</th>
                <th>Nama</th>
                {{-- <th>Lihat Rapot</th> --}}
                <td>Action</td>
            </tr>
            </thead>
            <tbody>
            
            @foreach ($siswasMasihSekolah as $siswa)
            
            <tr>
                <td>{{ $siswa->nis }}</td>
                <td>{{ $siswa->user->name }}</td>
                {{-- <td><a class="btn btn-info" href="{{ route('reports.show', ['report' => $siswa->nis]) }}"><i class="fas fa-fw fa-eye"></i></a></td> --}}
                <td>
                    <a class="btn btn-info" href="{{ route('students.show', ['student' => $siswa->nis]) }}"><i class="fas fa-fw fa-eye"></i></a>
                    <a class="btn btn-primary" href="javascript:void(0)" id="btn-edit-siswa" data-id="{{ $siswa->id }}"><i class="fas fa-fw fa-edit"></i> Edit</a>
                            <form action="{{ route('students.destroy', ['student' => $siswa->user->id]) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus siswa ini?')"><i class="fas fa-fw fa-trash"></i> Hapus</button>
                            </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <!-- End Table with stripped rows -->
        {{-- {{ $students->appends(request()->query())->links('pagination::bootstrap-4') }} --}}
    </div>
</div>
    @include('layouts.modals.editsiswa')
</div>

@endsection