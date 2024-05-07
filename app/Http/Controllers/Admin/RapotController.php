<?php

namespace App\Http\Controllers\Admin;

use App\Models\Rapot;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RapotController extends Controller
{
    public function show($id)
    {
        $rapots = Rapot::with(['siswa', 'siswa.user'])
            ->orderBy('tingkatan_kelas')
            ->orderBy('semester')
            ->where('nis', $id)->get();
        return view('admin.rapot.show', compact('rapots'));
    }
}
