@extends('template.main')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/rapot">Rapot</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Rapot</li>
    </ol>
</nav>
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-success text-white">
            <p class="mb-0">Edit Rapot</p>
        </div>
        <div class="card-body">
            <form action="{{ route('rapot.update',$rapot->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">
                <input type="hidden" name="nis" value="{{ $siswa->nis }}">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $siswa->user->name }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="tingkatan_kelas">Kelas:</label>
                    <select class="form-control" id="tingkatan_kelas" name="tingkatan_kelas">
                        <option value="play_group">Play Group</option>
                        <option value="tk_a">TK A</option>
                        <option value="tk_b">TK B</option>
                        <option value="tk_persiapan">TK Persiapan</option>
                        <option value="1">Kelas 1</option>
                        <option value="2">Kelas 2</option>
                        <option value="3">Kelas 3</option>
                        <option value="4">Kelas 4</option>
                        <option value="5">Kelas 5</option>
                        <option value="6">Kelas 6</option>
                        <option value="7">Kelas 7</option>
                        <option value="8">Kelas 8</option>
                        <option value="9">Kelas 9</option>
                    </select>
                  </div>
          
                  <div class="mb-3">
                    <label for="semester">Semester:</label>
                    <select class="form-control" id="semester" name="semester">
                      <option value="1">Semester 1</option>
                      <option value="2">Semester 2</option>
                    </select>
                  </div>
                <div class="mb-3">
                    <label for="rapot" class="form-label">Rapot</label>
                    <textarea class="form-control" id="rapot" name="rapot" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
