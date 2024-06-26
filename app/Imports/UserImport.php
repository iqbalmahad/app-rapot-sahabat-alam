<?php

namespace App\Imports;

use App\Models\Role;
use App\Models\User;
use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;

class UserImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        $user = User::create([
            'name' => $row[1],
            'username' => $row[2],
            'password' => $row[3],
        ]);

        $userRole = Role::where('name', 'client')->first();
        $user->assignRole($userRole);

        $siswaData = [
            'nis' => $row[2],
            'user_id' => $user->id,
        ];

        // Tambahkan tahun_masuk_tk, tahun_masuk_sd, tahun_masuk_smp jika ada nilai yang disediakan
        if (isset($row[4])) {
            $siswaData['tahun_masuk_tk'] = $row[4];
        }

        if (isset($row[5])) {
            $siswaData['tahun_masuk_sd'] = $row[5];
        }

        if (isset($row[6])) {
            $siswaData['tahun_masuk_smp'] = $row[6];
        }

        Siswa::create($siswaData);

        return $user;
    }
}
