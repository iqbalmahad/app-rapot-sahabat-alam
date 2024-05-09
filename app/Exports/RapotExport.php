<?php

namespace App\Exports;

use App\Models\Rapot;
use Maatwebsite\Excel\Concerns\FromCollection;

class RapotExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Rapot::all();
    }
}
