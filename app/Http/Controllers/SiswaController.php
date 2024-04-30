<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function indexInSchool()
    {
        $siswasMasihSekolah = Siswa::with('rapot')->where('status', true)->get();
        return view('siswa.index_in_school', compact('siswasMasihSekolah'));
    }

    public function indexGraduated()
    {
        $siswasLulus = Siswa::with('rapot')->where('status', false)->get();
        return view('siswa.index_graduated', compact('siswasLulus'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:siswas',
            'tahun_masuk_tk' => 'nullable|string',
            'tahun_masuk_sd' => 'nullable|string',
            'tahun_masuk_smp' => 'nullable|string',
            'user_uuid' => 'required|exists:users,id'
        ]);

        Siswa::create($request->all());

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil ditambahkan.');
    }

    public function edit(Siswa $siswa)
    {
        return view('siswa.edit', compact('siswa'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nis' => 'required|unique:siswas,nis,' . $siswa->id,
            'tahun_masuk_tk' => 'nullable|string',
            'tahun_masuk_sd' => 'nullable|string',
            'tahun_masuk_smp' => 'nullable|string',
            'user_uuid' => 'required|exists:users,id'
        ]);

        $siswa->update($request->all());

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil diperbarui.');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil dihapus.');
    }
}
