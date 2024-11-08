<?php

namespace App\Exports;

use App\Models\Imu;
use Maatwebsite\Excel\Concerns\FromCollection;

class ImusExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Imu::all();
    }
}
