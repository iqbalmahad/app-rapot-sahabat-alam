<?php

namespace App\Http\Controllers\Admin\TK;

use App\Models\User;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Models\Siswa\SiswaTK;
use App\Http\Controllers\Controller;

class SiswaTKController extends Controller
{

    // Menampilkan semua data siswa TK
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = SiswaTK::whereNull('tahun_masuk_sd')->whereNull('tahun_masuk_smp')->orderBy('tahun_masuk_tk');

        if ($search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('nis', 'like', "%$search%")
                    ->orWhere('tahun_masuk_tk', 'like', "%$search%");
            });
        }

        $siswas = $query->take(500)->paginate(10);
        return view('admin.siswa_tk.index', compact('siswas'));
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
        $siswa = SiswaTK::with('user')->where('nis', $id)->first();
        return view('admin.siswa_tk.show', compact('siswa'));
    }

    // Menampilkan form untuk mengedit data siswa TK
    public function edit($id)
    {
        $siswa = SiswaTK::where('nis', $id)->first();
        return view('admin.siswa_tk.edit', compact('siswa'));
    }

    // Mengupdate data siswa TK di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'nis' => 'required|unique:siswas,nis,' . $id,
            'status' => 'required',
            'tahun_masuk_tk' => 'nullable',
        ]);
        $siswa = SiswaTK::findOrFail($id);
        $user = User::where('id', $siswa->user->id)->first();
        $siswa->update($request->all());

        $siswa->update([
            'nis' => $request->input('nis'),
            'status' => $request->input('status'),
            'tahun_masuk_tk' => $request->input('tahun_masuk_tk'),
        ]);

        $user->update([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('siswa-tk.index')
            ->with('success', 'Data siswa SMP berhasil diperbarui.');
    }

    // Menghapus data siswa TK dari database
    public function destroy($id)
    {
        $user = User::with('siswa')->findOrFail($id);

        // Hapus user terkait jika ada
        if ($user->siswa->id) {
            Siswa::findOrFail($user->siswa->id)->delete();
        }

        $user->delete();

        return redirect()->route('siswa-tk.index')
            ->with('success', 'Data siswa TK berhasil dihapus.');
    }
}
