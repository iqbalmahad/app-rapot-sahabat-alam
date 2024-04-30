<?php

namespace Database\Seeders;

use App\Imports\RapotImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class RapotSeeder extends Seeder
{
    public function run(): void
    {
        Excel::import(new RapotImport, public_path('DataRapot/DataRapot.xlsx'));
    }
}
