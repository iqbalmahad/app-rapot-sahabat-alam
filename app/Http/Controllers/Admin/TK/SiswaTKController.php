<?php

namespace App\Http\Controllers\Admin\TK;

use Illuminate\Http\Request;
use App\Models\Siswa\SiswaTK;
use App\Http\Controllers\Controller;

class SiswaTKController extends Controller
{
    // Menampilkan semua data siswa TK
    public function index()
    {
        $siswas = SiswaTK::all();
        return view('siswa.index', compact('siswas'));
    }

    // Menampilkan form untuk membuat data siswa TK baru
    public function create()
    {
        return view('siswa.create');
    }

    // Menyimpan data siswa TK baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:siswas,nis',
            'tahun_masuk_tk' => 'nullable',
        ]);

        SiswaTK::create($request->all());

        return redirect()->route('siswa.index')
            ->with('success', 'Siswa TK berhasil ditambahkan.');
    }

    // Menampilkan detail data siswa TK
    public function show($id)
    {
        $siswa = SiswaTK::findOrFail($id);
        return view('siswa.show', compact('siswa'));
    }

    // Menampilkan form untuk mengedit data siswa TK
    public function edit($id)
    {
        $siswa = SiswaTK::findOrFail($id);
        return view('siswa.edit', compact('siswa'));
    }

    // Mengupdate data siswa TK di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'nis' => 'required|unique:siswas,nis,' . $id,
            'tahun_masuk_tk' => 'nullable',
            // tambahkan validasi lainnya sesuai kebutuhan
        ]);

        $siswa = SiswaTK::findOrFail($id);
        $siswa->update($request->all());

        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa TK berhasil diperbarui.');
    }

    // Menghapus data siswa TK dari database
    public function destroy($id)
    {
        $siswa = SiswaTK::findOrFail($id);
        $siswa->delete();

        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa TK berhasil dihapus.');
    }
}
