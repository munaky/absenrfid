<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AbsensiExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(json_decode(session()->get('data_absensi')));
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'Kelas',
            'Tanggal',
            'Mata Pelajaran',
            'Status',
            'Jam Masuk',
            'Jam Keluar',
            'Ruang'
        ];
    }
}
