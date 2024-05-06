<?php

namespace App\Http\Controllers\Admin\SD;

use Illuminate\Http\Request;
use App\Models\Siswa\SiswaSD;
use App\Http\Controllers\Controller;

class SiswaSDController extends Controller
{
    // Menampilkan semua data siswa SD
    public function index()
    {
        $siswas = SiswaSD::all();
        return view('siswa_sd.index', compact('siswas'));
    }

    // Menampilkan form untuk membuat data siswa SD baru
    public function create()
    {
        return view('siswa_sd.create');
    }

    // Menyimpan data siswa SD baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:siswa_sd,nis',
            'tahun_masuk_sd' => 'nullable',
            // tambahkan validasi lainnya sesuai kebutuhan
        ]);

        SiswaSD::create($request->all());

        return redirect()->route('siswa_sd.index')
            ->with('success', 'Siswa SD berhasil ditambahkan.');
    }

    // Menampilkan detail data siswa SD
    public function show($id)
    {
        $siswa = SiswaSD::findOrFail($id);
        return view('siswa_sd.show', compact('siswa'));
    }

    // Menampilkan form untuk mengedit data siswa SD
    public function edit($id)
    {
        $siswa = SiswaSD::findOrFail($id);
        return view('siswa_sd.edit', compact('siswa'));
    }

    // Mengupdate data siswa SD di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'nis' => 'required|unique:siswa_sd,nis,' . $id,
            'tahun_masuk_sd' => 'nullable',
            // tambahkan validasi lainnya sesuai kebutuhan
        ]);

        $siswa = SiswaSD::findOrFail($id);
        $siswa->update($request->all());

        return redirect()->route('siswa_sd.index')
            ->with('success', 'Data siswa SD berhasil diperbarui.');
    }

    // Menghapus data siswa SD dari database
    public function destroy($id)
    {
        $siswa = SiswaSD::findOrFail($id);
        $siswa->delete();

        return redirect()->route('siswa_sd.index')
            ->with('success', 'Data siswa SD berhasil dihapus.');
    }
}
