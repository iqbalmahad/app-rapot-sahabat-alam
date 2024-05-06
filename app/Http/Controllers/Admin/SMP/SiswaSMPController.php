<?php

namespace App\Http\Controllers\Admin\SMP;

use App\Models\User;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Models\Siswa\SiswaSMP;
use App\Http\Controllers\Controller;

class SiswaSMPController extends Controller
{
    // Menampilkan semua data siswa SMP
    public function index()
    {
        $siswas = SiswaSMP::whereNotNull('tahun_masuk_smp')->orderBy('tahun_masuk_smp')->get();
        return view('admin.siswa_smp.index', compact('siswas'));
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
        $siswa = SiswaSMP::where('nis', $id)->first();
        return view('admin.siswa_smp.edit', compact('siswa'));
    }

    // Mengupdate data siswa SMP di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'nis' => 'required|unique:siswas,nis,' . $id,
            'status' => 'required',
            'tahun_masuk_smp' => 'nullable',
        ]);

        $siswa = SiswaSMP::findOrFail($id);
        $user = User::where('id', $siswa->user->id)->first();
        $siswa->update($request->all());

        $siswa->update([
            'nis' => $request->input('nis'),
            'status' => $request->input('status'),
            'tahun_masuk_smp' => $request->input('tahun_masuk_smp'),
        ]);

        $user->update([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('siswa-smp.index')
            ->with('success', 'Data siswa SMP berhasil diperbarui.');
    }

    // Menghapus data siswa SMP dari database
    public function destroy($id)
    {
        $user = User::with('siswa')->findOrFail($id);

        // Hapus user terkait jika ada
        if ($user->siswa->id) {
            Siswa::findOrFail($user->siswa->id)->delete();
        }

        $user->delete();

        return redirect()->route('siswa_smp.index')
            ->with('success', 'Data siswa SMP berhasil dihapus.');
    }
}
