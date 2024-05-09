<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Siswa\SiswaTK;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;

class SiswaTKImport implements ToModel
{

    public function model(array $row)
    {
        // Ubah tahun_masuk_tk ke dalam bentuk string jika dalam bentuk integer
        $tahun_masuk_tk = is_int($row[2]) ? (string) $row[2] : $row[2];

        // Validasi input data
        $validator = Validator::make([
            'name' => $row[0], // Sesuaikan dengan indeks kolom yang sesuai di array $row
            'nis' => $row[1],
            'tahun_masuk_tk' => $tahun_masuk_tk,
        ], [
            'name' => 'required|string|max:255',
            'nis' => 'required|unique:siswas,nis',
            'tahun_masuk_tk' => 'required|string|max:255',
        ]);

        // Cek apakah validasi gagal
        if ($validator->fails()) {
            // Jika validasi gagal, throw exception dengan pesan error
            throw new \Exception($validator->errors()->first());
        }

        // Buat dan simpan model SiswaTK
        SiswaTK::create([
            'nis' => $row[1],
            'user_id' => User::create([
                'name' => $row[0], // Sesuaikan dengan indeks kolom yang sesuai di array $row
                'username' => $row[1],
                'password' => 'password',
            ])->id,
            'tahun_masuk_tk' => $row[2],
            // Tambahkan tahun_masuk_sd, tahun_masuk_smp jika ada nilai yang disediakan
        ]);
    }
}
