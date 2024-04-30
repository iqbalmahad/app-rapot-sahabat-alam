<?php

namespace Database\Seeders;

use App\Imports\UserImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class UserAndSiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Excel::import(new UserImport, public_path('DataSiswa/DataSiswa.xlsx'));
    }
}
