<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Rapot;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HakAksesSiswaController extends Controller
{
    public function lihatRapot()
    {
        $siswa = Siswa::with('user')->where('user_id', Auth::user()->id)->first();
        $rapots = Rapot::orderBy('tingkatan_kelas')
            ->orderBy('semester')
            ->where('nis', $siswa->nis)->get();
        if (!$rapots->isEmpty()) {
            return view('client.rapot.show', compact('rapots', 'siswa'));
        } else {
            return view('client.rapot.rapot_null');
        }
    }
}
