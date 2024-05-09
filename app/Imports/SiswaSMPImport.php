<?php

namespace App\Imports;

use App\Models\Role;
use App\Models\User;
use App\Models\Siswa\SiswaSMP;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;

class SiswaSMPImport implements ToModel
{
    public function model(array $row)
    {
        // Ubah tahun_masuk_smp ke dalam bentuk string jika dalam bentuk integer
        $tahun_masuk_smp = is_int($row[2]) ? (string) $row[2] : $row[2];

        // Validasi input data
        $validator = Validator::make([
            'name' => $row[0], // Sesuaikan dengan indeks kolom yang sesuai di array $row
            'nis' => $row[1],
            'tahun_masuk_smp' => $tahun_masuk_smp,
        ], [
            'name' => 'required|string|max:255',
            'nis' => 'required|unique:siswas,nis',
            'tahun_masuk_smp' => 'required|string|max:255',
        ]);

        // Cek apakah validasi gagal
        if ($validator->fails()) {
            // Jika validasi gagal, throw exception dengan pesan error
            throw new \Exception($validator->errors()->first());
        }

        // Buat pengguna (user)
        $user = User::create([
            'name' => $row[0], // Sesuaikan dengan indeks kolom yang sesuai di array $row
            'username' => $row[1],
            'password' => 'password',
        ]);

        // Tentukan peran pengguna (user role) berdasarkan nama peran
        $userRole = Role::where('name', 'client')->first();

        // Beri peran kepada pengguna (assign role to user)
        $user->assignRole($userRole);

        // Buat dan simpan model SiswaTK
        SiswaSMP::create([
            'nis' => $row[1],
            'user_id' => $user->id,
            'tahun_masuk_tk' => $row[2],
            // Tambahkan tahun_masuk_sd, tahun_masuk_smp jika ada nilai yang disediakan
        ]);
    }
}
