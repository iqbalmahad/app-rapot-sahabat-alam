<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Imports\SiswaSDImport;
use App\Imports\SiswaTKImport;
use App\Imports\SiswaSMPImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function getImportSiswaTK()
    {
        return view('admin.import.import_siswa_tk');
    }

    public function storeImportSiswaTK(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048', // Batasi hanya menerima file Excel
        ]);

        // Ambil file yang diupload
        $file = $request->file('file');

        try {
            // Import data dari file Excel menggunakan SiswaTKImport
            Excel::import(new SiswaTKImport, $file);

            // Jika berhasil, redirect dengan pesan sukses
            return redirect()->route('siswa-tk.index')->with('success', 'Data Siswa TK berhasil diimport.');
        } catch (\Exception $e) {
            // Jika terjadi error, redirect dengan pesan error
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function getImportSiswaSD()
    {
        return view('admin.import.import_siswa_sd');
    }

    public function storeImportSiswaSD(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048', // Batasi hanya menerima file Excel
        ]);

        // Ambil file yang diupload
        $file = $request->file('file');

        try {
            // Import data dari file Excel menggunakan SiswaTKImport
            Excel::import(new SiswaSDImport, $file);

            // Jika berhasil, redirect dengan pesan sukses
            return redirect()->route('siswa-sd.index')->with('success', 'Data Siswa SD berhasil diimport.');
        } catch (\Exception $e) {
            // Jika terjadi error, redirect dengan pesan error
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function getImportSiswaSMP()
    {
        return view('admin.import.import_siswa_smp');
    }

    public function storeImportSiswaSMP(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048', // Batasi hanya menerima file Excel
        ]);

        // Ambil file yang diupload
        $file = $request->file('file');

        try {
            // Import data dari file Excel menggunakan SiswaTKImport
            Excel::import(new SiswaSMPImport, $file);

            // Jika berhasil, redirect dengan pesan sukses
            return redirect()->route('siswa-smp.index')->with('success', 'Data Siswa SMP berhasil diimport.');
        } catch (\Exception $e) {
            // Jika terjadi error, redirect dengan pesan error
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function getImportRapot()
    {
        return view('admin.import.import_rapot');
    }
}
