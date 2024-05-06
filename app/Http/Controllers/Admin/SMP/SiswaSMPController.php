<?php

namespace App\Http\Controllers\Admin\SMP;

use Illuminate\Http\Request;
use App\Models\Siswa\SiswaSMP;
use App\Http\Controllers\Controller;

class SiswaSMPController extends Controller
{
    // Menampilkan semua data siswa SMP
    public function index()
    {
        $siswas = SiswaSMP::all();
        return view('siswa_smp.index', compact('siswas'));
    }

    // Menampilkan form untuk membuat data siswa SMP baru
    public function create()
    {
        return view('siswa_smp.create');
    }

    // Menyimpan data siswa SMP baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:siswa_smp,nis',
            'tahun_masuk_smp' => 'nullable',
            // tambahkan validasi lainnya sesuai kebutuhan
        ]);

        SiswaSMP::create($request->all());

        return redirect()->route('siswa_smp.index')
            ->with('success', 'Siswa SMP berhasil ditambahkan.');
    }

    // Menampilkan detail data siswa SMP
    public function show($id)
    {
        $siswa = SiswaSMP::findOrFail($id);
        return view('siswa_smp.show', compact('siswa'));
    }

    // Menampilkan form untuk mengedit data siswa SMP
    public function edit($id)
    {
        $siswa = SiswaSMP::findOrFail($id);
        return view('siswa_smp.edit', compact('siswa'));
    }

    // Mengupdate data siswa SMP di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'nis' => 'required|unique:siswa_smp,nis,' . $id,
            'tahun_masuk_smp' => 'nullable',
            // tambahkan validasi lainnya sesuai kebutuhan
        ]);

        $siswa = SiswaSMP::findOrFail($id);
        $siswa->update($request->all());

        return redirect()->route('siswa_smp.index')
            ->with('success', 'Data siswa SMP berhasil diperbarui.');
    }

    // Menghapus data siswa SMP dari database
    public function destroy($id)
    {
        $siswa = SiswaSMP::findOrFail($id);
        $siswa->delete();

        return redirect()->route('siswa_smp.index')
            ->with('success', 'Data siswa SMP berhasil dihapus.');
    }
}
