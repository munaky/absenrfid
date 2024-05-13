<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\GetDataController;
use App\Http\Controllers\PageController;

class FilterDataController extends Controller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */

    public static function filterMurid(Request $request){
        info('controller FilterDataController filterMurid ----------');

        if($request->input('kelas') == 'All' || $request->input('jurusan') == 'All'){
            $kelas = " ";
            session(['filter_murid' => "$kelas"]);
        }
        else if($request->has('kelas') || $request->has('jurusan')){
            $kelas = $request->input('kelas') . ' ' . $request->input('jurusan');
            session(['filter_murid' => "$kelas"]);
        }
        else if(session()->has('filter_murid')){
            $kelas = session()->get('filter_murid');
        }
        else{
            return redirect('/data_murid');
        }

        $dataMurid = GetDataController::getMurid($kelas);
        $dataKelas = GetDataController::getKelas();
        $data = array('murid' => $dataMurid, 'kelas' => $dataKelas);

        $content = view('data_murid', ['data' => $data]);
        $fullPage = PageController::includeSidebar($content);

        session(['filtered' => "$fullPage"]);

        return redirect('/filter/data_murid');
    }

    public static function filterJadwalPelajaran(Request $request){
        info('controller FilterDataController filterJadwalPelajaran ----------');

        if($request->has('ruang')){
            $ruang = $request->input('ruang');
        }
        else{
            return redirect('/jadwal_pelajaran');
        }

        $id_ruang = DB::table('tb_ruang')->where('nama', $ruang)->get('id_ruang');

        $jadwal = GetDataController::getJadwalRuang($id_ruang[0]->id_ruang);
        $content = view('jadwal_pelajaran', ['jadwal' => $jadwal, 'ruang' => $ruang]);
        $fullPage = PageController::includeSidebar($content);

        session(['filtered' => "$fullPage"]);

        return redirect('/filter/jadwal_pelajaran');
    }

    public static function filterRekapAbsensi(Request $request){
        info('controller FilterDataController filterRekapAbsensi ----------');

        if(!$request->has('rekap') || !$request->has('kelas')){
            return redirect('/rekap_absensi');
        }

        $absensi = array();
        $rekap = $request->input('rekap');
        $kelas = $request->input('kelas');
        $listMurid = GetDataController::getMurid($kelas);
        $listKelas = GetDataController::getKelas();
        $listMapel = GetDataController::getMapel();
        $listRuang = GetDataController::getNamaRuang();
        $id_kelas = -1;
        $tanggal = date('Y/m/d');
        $index = 1;

        foreach($listKelas as $x){
            if($kelas == $x['kelas']){
                $id_kelas = $x['id_kelas'];
            }
        }
        if($id_kelas == -1){
            return back();
        }

        if($rekap == 'Per 1 Minggu'){
            $rTanggal = date_format(date_modify(date_create($tanggal), '-7 days'), 'Y/m/d');
        }
        else if($rekap == 'Per 2 Minggu'){
            $rTanggal = date_format(date_modify(date_create($tanggal), '-14 days'), 'Y/m/d');
        }
        else if($rekap == 'Per 3 Minggu'){
            $rTanggal = date_format(date_modify(date_create($tanggal), '-21 days'), 'Y/m/d');
        }
        else if($rekap == 'Per Bulan'){
            $rTanggal = date_format(date_modify(date_create($tanggal), '-30 days'), 'Y/m/d');
        }
        else{
            $rTanggal = date_format(date_modify(date_create($tanggal), '-9999 days'), 'Y/m/d');
        }

        $dbAbsensi = DB::table('tb_absensi')->where('id_kelas', $id_kelas)->whereBetween('tanggal', [$rTanggal, $tanggal])->get('*');
        if(count($dbAbsensi) == 0){
            return back();
        }

        foreach($dbAbsensi as $x){
            $nama = '-';
            $mapel = '-';
            $ruang = '-';

            foreach($listMurid as $y){
                if($x->id_murid == $y['id_murid']){
                    $nama = $y['nama'];
                }
            }

            foreach($listMapel as $y){
                if($x->id_mapel == $y['id_mapel']){
                    $mapel = $y['mapel'];
                }
            }

            foreach($listRuang as $y){
                if($x->id_ruang == $y['id_ruang']){
                    $ruang = $y['nama'];
                }
            }

            array_push($absensi, array('no' => $index, 'nama' => $nama, 'kelas' => $kelas, 'tanggal' => $tanggal, 'mapel' => $mapel, 'status' => $x->status, 'jam_masuk' => $x->jam_masuk, 'jam_keluar' => $x->jam_keluar, 'ruang' => $ruang));
            $index++;
        }

        session(['data_absensi' => json_encode($absensi)]);

        $content = view('rekap_absensi', ['absensi' => $absensi]);
        $fullPage = PageController::includeSidebar($content);

        session(['filtered' => "$fullPage"]);

        return redirect('/filter/rekap_absensi');
    }

}
