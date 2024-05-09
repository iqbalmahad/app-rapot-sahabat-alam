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
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = SiswaSMP::whereNotNull('tahun_masuk_smp')->orderBy('tahun_masuk_smp');

        if ($search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('nis', 'like', "%$search%")
                    ->orWhere('tahun_masuk_smp', 'like', "%$search%");
            });
        }

        $siswas = $query->take(500)->paginate(10);

        return view('admin.siswa_smp.index', compact('siswas'));
    }

    // Menampilkan form untuk membuat data siswa SMP baru
    public function create()
    {
        return view('admin.siswa_smp.create');
    }

    // Menyimpan data siswa SMP baru ke database
    public function store(Request $request)
    {
        // Validasi input data
        $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|unique:siswas,nis',
            'tahun_masuk_smp' => 'required|string|max:255',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->nis;
        $user->email = null;
        $user->password = 'password';
        $user->save();

        $siswa = new SiswaSMP();
        $siswa->nis = $request->nis;
        $siswa->tahun_masuk_smp = $request->tahun_masuk_smp;
        $siswa->user_id = $user->id;
        $siswa->save();

        // Redirect ke halaman yang dituju setelah berhasil menyimpan data
        return redirect()->route('siswa-smp.index')->with('success', 'Siswa berhasil ditambahkan.');
    }

    // Menampilkan detail data siswa SMP
    public function show($id)
    {
        $siswa = SiswaSMP::with('user')->where('nis', $id)->first();
        return view('admin.siswa_smp.show', compact('siswa'));
    }

    // Menampilkan form untuk mengedit data siswa SMP
    public function edit($id)
    {
        $siswa = SiswaSMP::with('user')->where('nis', $id)->first();
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
            ->with('successupdate', 'Data siswa SMP berhasil diperbarui.');
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

        return redirect()->route('siswa-smp.index')
            ->with('delete', 'Data siswa SMP berhasil dihapus.');
    }
}
