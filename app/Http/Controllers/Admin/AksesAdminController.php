<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Siswa\SiswaSD;
use App\Models\Siswa\SiswaTK;
use App\Models\Siswa\SiswaSMP;
use App\Http\Controllers\Controller;

class AksesAdminController extends Controller
{
    public function pilihTahunLulusTK()
    {
        return view('admin.akses.pilih_tahun_lulus_tk');
    }

    public function filterTK(Request $request)
    {
        $tahunMasukTK = $request->input('tahun_masuk_tk');
        $status = 1; // Status siswa yang diinginkan
        $siswaTKs = SiswaTK::with('user')->where('tahun_masuk_tk', $tahunMasukTK)
            ->where('status', $status)
            ->get();
        $selectedTahunMasukTK = $tahunMasukTK;

        return view('admin.akses.filter_siswa_tk', compact('siswaTKs', 'selectedTahunMasukTK'));
    }

    public function processTK(Request $request)
    {
        $siswaIds = $request->input('siswa_ids');

        // Ubah status siswa menjadi 0
        SiswaTK::whereIn('id', $siswaIds)->update(['status' => 0]);

        return redirect()->route('siswa-tk.index')->with('success', 'Status siswa berhasil diubah.');
    }

    public function pilihTahunLulusSD()
    {
        return view('admin.akses.pilih_tahun_lulus_sd');
    }

    public function filterSD(Request $request)
    {
        $tahunMasukSD = $request->input('tahun_masuk_sd');
        $status = 1; // Status siswa yang diinginkan
        $siswaSDs = SiswaSD::with('user')->where('tahun_masuk_sd', $tahunMasukSD)
            ->where('status', $status)
            ->get();
        $selectedTahunMasukSD = $tahunMasukSD;

        return view('admin.akses.filter_siswa_sd', compact('siswaSDs', 'selectedTahunMasukSD'));
    }

    public function processSD(Request $request)
    {
        $siswaIds = $request->input('siswa_ids');

        // Ubah status siswa menjadi 0
        SiswaSD::whereIn('id', $siswaIds)->update(['status' => 0]);

        return redirect()->route('siswa-sd.index')->with('success', 'Status siswa berhasil diubah.');
    }

    public function pilihTahunLulusSMP()
    {
        return view('admin.akses.pilih_tahun_lulus_smp');
    }

    public function filterSMP(Request $request)
    {
        $tahunMasukSMP = $request->input('tahun_masuk_smp');
        $status = 1; // Status siswa yang diinginkan
        $siswaSMPs = SiswaSMP::with('user')->where('tahun_masuk_smp', $tahunMasukSMP)
            ->where('status', $status)
            ->get();
        $selectedTahunMasukSMP = $tahunMasukSMP;

        return view('admin.akses.filter_siswa_smp', compact('siswaSMPs', 'selectedTahunMasukSMP'));
    }

    public function processSMP(Request $request)
    {
        $siswaIds = $request->input('siswa_ids');

        // Ubah status siswa menjadi 0
        SiswaSMP::whereIn('id', $siswaIds)->update(['status' => 0]);

        return redirect()->route('siswa-smp.index')->with('success', 'Status siswa berhasil diubah.');
    }
}
