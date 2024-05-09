@extends('template.main')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-5">
            <div class="card shadow">
                <div class="card-header mb-0">
                    <p class="mb-0">Detail Siswa</p>
                </div>
                <div class="card-body">
                    <p>Nama : {{ $siswa->user->name }}</p>
                    <p>Nis : {{ $siswa->nis }}</p>
                    <p>Status : 
                        @if ($siswa->status == 1)
                            Masih Sekolah
                        @else
                            Alumni
                        @endif
                    </p>
                    <p>Tahun Masuk:</p>
                    <ul>
                        <li>TK : @if ($siswa->tahun_masuk_tk != null)
                           {{ $siswa->tahun_masuk_tk }} 
                        @else
                            tidak ada data
                        @endif</li>
                        <li>SD : @if ($siswa->tahun_masuk_sd != null)
                            {{ $siswa->tahun_masuk_sd }} 
                         @else
                             tidak ada data
                         @endif</li>
                        <li>SMP : @if ($siswa->tahun_masuk_smp != null)
                            {{ $siswa->tahun_masuk_smp }} 
                         @else
                             tidak ada data
                         @endif</li>
                    </ul>
                    <hr>
                    <a class="btn btn-primary" href="{{ route('siswa-sd.index') }}">kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection