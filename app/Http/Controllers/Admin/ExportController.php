<?php

namespace App\Http\Controllers\Admin;

use App\Exports\RapotExport;
use App\Exports\SiswaExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportRapot()
    {
        return Excel::download(new RapotExport, 'rapot.xlsx');
    }

    public function exportSiswa()
    {
        return Excel::download(new SiswaExport, 'siswa.xlsx');
    }
}
