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

    public function headings(): array
    {
        return [
            'ID',
            'X',
            'Y',
            'Z',
            'Location',
            'Latitude',
            'Longitude',
            'Altitude',
            'Status',
            'Description',
            'Created At',
            'Updated At',
        ];
    }
}
