<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Rapot;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiswaController extends Controller
{
    public function indexInSchool()
    {
        // $siswasMasihSekolah = User::with(['siswa' => function ($query) {
        //     $query->where('status', true);
        // }])->get();
        // $siswasMasihSekolah = Siswa::with('rapot')->where('status', true)->get();
        $siswasMasihSekolah = Siswa::with(['rapot', 'user'])->where('status', true)->get();
        return view('siswa.index_in_school', compact('siswasMasihSekolah'));
    }

    public function indexGraduated()
    {
        $siswasLulus = Siswa::with('rapot')->where('status', false)->get();
        return view('siswa.index_graduated', compact('siswasLulus'));
    }

    public function show(Siswa $student)
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Post',
            'data'    => $student
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:siswas',
            'tahun_masuk_tk' => 'nullable|string',
            'tahun_masuk_sd' => 'nullable|string',
            'tahun_masuk_smp' => 'nullable|string',
            'user_id' => 'required|exists:users,id'
        ]);

        Siswa::create($request->all());

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil ditambahkan.');
    }

    public function edit($siswa)
    {
        $siswa = Siswa::where('id', $siswa)->first();
        return response()->json([
            'status' => 200,
            'data'    => $siswa
        ]);
    }

    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nis' => 'required|unique:siswas,nis,' . $siswa->id,
            'tahun_masuk_tk' => 'nullable|string',
            'tahun_masuk_sd' => 'nullable|string',
            'tahun_masuk_smp' => 'nullable|string',
            'user_id' => 'required|exists:users,id'
        ]);

        $siswa->update([
            'nis' => $request->edit_nis,
            'tahun_masuk_tk' => $request->edit_tahun_masuk_tk,
            'tahun_masuk_sd' => $request->edit_tahun_masuk_sd,
            'tahun_masuk_smp' => $request->edit_tahun_masuk_smp,
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diupdate!',
            'data'    => $siswa
        ]);
    }

    public function destroy(User $student)
    {
        $siswa = Siswa::where('nis', $student->siswa->nis)->first();
        $rapot = Rapot::where('nis', $student->siswa->nis)->first();
        if ($rapot) {
            $rapot->delete();
        }
        if ($siswa) {
            $siswa->delete();
        }
        $student->delete();

        return redirect()->route('siswa.index_in_school')->with('success', 'Siswa berhasil dihapus.');
    }
}
