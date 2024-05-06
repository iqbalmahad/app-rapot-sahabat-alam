<?php

namespace App\Imports;

use App\Models\Rapot;
use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;

class RapotImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $siswa = Siswa::where('nis', $row[1])->first();

        return new Rapot([
            'nis' => $siswa->nis,
            'tingkatan_kelas' => $row[2],
            'semester' => $row[3],
            'rapot' => $row[4],
            'siswa_id' => $siswa->id,
        ]);
    }
}
