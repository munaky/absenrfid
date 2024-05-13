<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\AbsensiExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as CustomExport;

class ExportController extends Controller
{
    //

    public function exportFile(){
        info('controller ExportController exportFile ----------');

        if (session()->missing('data_absensi')) {
            return redirect('/rekap_absensi');
        }

        return Excel::download(new AbsensiExport, 'absensi.xlsx');
    }
}
