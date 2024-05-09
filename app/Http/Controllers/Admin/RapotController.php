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
}
