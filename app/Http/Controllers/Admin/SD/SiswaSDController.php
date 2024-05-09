<?php

namespace App\Http\Controllers\Admin\SD;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Siswa\SiswaSD;
use App\Http\Controllers\Controller;
use App\Models\Siswa;

class SiswaSDController extends Controller
{
    // Menampilkan semua data siswa SD
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = SiswaSD::whereNotNull('tahun_masuk_sd')->whereNull('tahun_masuk_smp')->orderBy('tahun_masuk_sd');

        if ($search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('nis', 'like', "%$search%")
                    ->orWhere('tahun_masuk_sd', 'like', "%$search%");
            });
        }

        $siswas = $query->take(500)->paginate(10);
        return view('admin.siswa_sd.index', compact('siswas'));
    }


    // Menampilkan form untuk membuat data siswa SD baru
    public function create()
    {
        return view('admin.siswa_sd.create');
    }

    // Menyimpan data siswa SD baru ke database
    public function store(Request $request)
    {
        // Validasi input data
        $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|unique:siswas,nis',
            'tahun_masuk_sd' => 'required|string|max:255',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->nis;
        $user->email = null;
        $user->password = 'password';
        $user->save();

        $siswa = new SiswaSD();
        $siswa->nis = $request->nis;
        $siswa->tahun_masuk_sd = $request->tahun_masuk_sd;
        $siswa->user_id = $user->id;
        $siswa->save();

        // Redirect ke halaman yang dituju setelah berhasil menyimpan data
        return redirect()->route('siswa-sd.index')->with('success', 'Siswa berhasil ditambahkan.');
    }

    // Menampilkan detail data siswa SD
    public function show($id)
    {
        $siswa = SiswaSD::with('user')->where('nis', $id)->first();
        return view('admin.siswa_sd.show', compact('siswa'));
    }

    // Menampilkan form untuk mengedit data siswa SD
    public function edit($id)
    {
        $siswa = SiswaSD::where('nis', $id)->first();
        return view('admin.siswa_sd.edit', compact('siswa'));
    }

    // Mengupdate data siswa SD di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'nis' => 'required|string|unique:siswas,nis,' . $id,
            'status' => 'required',
            'tahun_masuk_sd' => 'nullable|string',
        ]);

        $siswa = SiswaSD::findOrFail($id);
        $user = User::where('id', $siswa->user->id)->first();
        $siswa->update($request->all());

        $siswa->update([
            'nis' => $request->input('nis'),
            'status' => $request->input('status'),
            'tahun_masuk_sd' => $request->input('tahun_masuk_sd'),
        ]);

        $user->update([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('siswa-sd.index')
            ->with('successupdate', 'Data siswa SMP berhasil diperbarui.');
    }

    // Menghapus data siswa SD dari database
    public function destroy($id)
    {
        $user = User::with('siswa')->findOrFail($id);

        // Hapus user terkait jika ada
        if ($user->siswa->id) {
            Siswa::findOrFail($user->siswa->id)->delete();
        }

        $user->delete();

        return redirect()->route('siswa-sd.index')
            ->with('delete', 'Data siswa SD dan user terkait berhasil dihapus.');
    }
}
