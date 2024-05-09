@extends('template.main')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Rapot</li>
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
<div class="card mb-3">
    <div class="card-header bg-success text-white">
        <p class="mb-0">
            Rapot {{ $rapots[0]->siswa->user->name }}
        </p>
    </div>
    
    <div class="card-body">
        <!-- Form Pencarian -->
        <div class="d-flex justify-content-between mb-3">
            <a class="btn btn-outline-primary" href="{{ route('rapot.create', $rapots[0]->siswa->nis) }}">tambah rapot</a>
        </div>
        <table id="datatables" class="table datatable table-hover table-bordered">
            <thead>
            <tr>
                <th>Kelas</th>
                <th>Semester</th>
                <th>Download</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            
            @foreach ($rapots as $rapot)
            
            <tr>
                <td>
                    @if($rapot->tingkatan_kelas == 'play_group')
                        Play Group
                    @elseif($rapot->tingkatan_kelas == 'tk_a')
                        TK A
                    @elseif($rapot->tingkatan_kelas == 'tk_b')
                        TK B
                    @else
                        Kelas {{ $rapot->tingkatan_kelas }}
                    @endif
                </td>
                <td>{{ $rapot->semester }}</td>
                <td><a href="{{  $rapot->rapot  }}">link download</a></td>
                <td>
                    <a class="btn btn-primary" href="{{ route('rapot.edit', ['rapot' => $rapot->id]) }}"><i class="fas fa-fw fa-edit"></i> Edit</a>
                            <form action="{{ route('rapot.destroy', ['rapot' => $rapot->id]) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus rapot ini?')"><i class="fas fa-fw fa-trash"></i> Hapus</button>
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