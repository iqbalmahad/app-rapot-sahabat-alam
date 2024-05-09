<?php

namespace App\Http\Controllers\Admin;

use App\Models\Rapot;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Siswa;

class RapotController extends Controller
{
    public function show($id)
    {
        $rapots = Rapot::with(['siswa', 'siswa.user'])
            ->orderBy('tingkatan_kelas')
            ->orderBy('semester')
            ->where('nis', $id)->get();
        if (!$rapots->isEmpty()) {
            return view('admin.rapot.show', compact('rapots'));
        } else {
            $siswa = Siswa::with('user')->where('nis', $id)->first();
            return view('admin.rapot.rapot_null', compact('siswa'));
        }
    }

    public function create($nis)
    {
        $siswa = Siswa::with('user')->where('nis', $nis)->first();
        return view('admin.rapot.create', compact('siswa'));
    }

    public function store(Request $request)
    {
        // Validasi input data
        $validatedData = $request->validate([
            'nis' => 'required|string|max:20',
            'tingkatan_kelas' => 'required|string|max:100',
            'semester' => 'required|integer',
            'rapot' => 'required|url|max:255',
            'siswa_id' => 'required|exists:siswas,id',
        ]);

        // Buat instance baru dari model Rapot
        $rapot = new Rapot();
        $rapot->nis = $validatedData['nis'];
        $rapot->tingkatan_kelas = $validatedData['tingkatan_kelas'];
        $rapot->semester = $validatedData['semester'];
        $rapot->rapot = $validatedData['rapot'];
        $rapot->siswa_id = $validatedData['siswa_id'];

        $rapot->save();

        return redirect()->route('rapot.show', ['rapot' => $validatedData['nis']])->with('success', 'Rapot berhasil ditambahkan.');
    }


    public function edit($id)
    {
        // Cari data rapot yang akan di-edit
        $rapot = Rapot::findOrFail($id);

        // Load data siswa untuk keperluan form
        $siswa = Siswa::with('user')->where('nis', $rapot->nis)->first();

        return view('admin.rapot.edit', compact('rapot', 'siswa'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input data
        $validatedData = $request->validate([
            'tingkatan_kelas' => 'required|string|max:100',
            'semester' => 'required|integer',
            'rapot' => 'required|url|max:255',
            'siswa_id' => 'required|exists:siswas,id',
        ]);

        // Cari data rapot yang akan di-update
        $rapot = Rapot::findOrFail($id);

        // Update data rapot
        $rapot->tingkatan_kelas = $validatedData['tingkatan_kelas'];
        $rapot->semester = $validatedData['semester'];
        $rapot->rapot = $validatedData['rapot'];
        $rapot->siswa_id = $validatedData['siswa_id'];

        $rapot->save();

        return redirect()->route('rapot.show', ['rapot' => $rapot->nis])->with('success', 'Rapot berhasil di-update.');
    }


    public function destroy($id)
    {
        // Cari data rapot yang akan dihapus
        $rapot = Rapot::findOrFail($id);

        // Simpan nilai nis sebelum menghapus data rapot
        $nis = $rapot->nis;

        // Hapus data rapot
        $rapot->delete();

        // Redirect ke halaman rapot.show dengan mengirim parameter nis
        return redirect()->route('rapot.show', ['rapot' => $nis])->with('success', 'Rapot berhasil dihapus.');
    }
}
