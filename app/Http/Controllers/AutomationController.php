<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\GetDataController;
use App\Http\Controllers\AnyController;

class AutomationController extends Controller
{
    //

    public static function autoUpdateRuang(){
        info('controller AutomationController autoUpdateRuang ----------');

        $hari = AnyController::DayToHari(date('D'));
        $jam = strtotime(date('H:i'));
        $jamJampel = '';
        $tanggal = date('Y/m/d');
        $jampel = GetDataController::getJampelByHari($hari);
        if($jampel == false){
            info('getJampelByHari Failed');
            return;
        }

        $ruang = GetDataController::getRuangByHari($hari);
        if($ruang == false){
            info('getRuangByHari Failed');
            return;
        }

        for($x = 1; $x <= count($jampel); $x++){
            $start = strtotime($jampel[$x]['start']);
            $end = strtotime($jampel[$x]['end']);
            if($jam == $start || $jam > $start && $jam < $end){
                $jamJampel = $x;
            }
        }

        foreach($ruang as $x){
            $id_ruang = $x['id_ruang'];
            $start = $x['start'];
            $end = $x['end'];

            for($y = 1; $y <= count($x[$hari]); $y++){
                $jadwal_masuk = $x[$hari][$y]['jadwal_masuk'];
                $jadwal_keluar = $x[$hari][$y]['jadwal_keluar'];
                $id_mapel = $x[$hari][$y]['id_mapel'];
                $id_guru = $x[$hari][$y]['id_guru'];
                $id_kelas = $x[$hari][$y]['id_kelas'];

                if($jamJampel >= $jadwal_masuk && $jamJampel <= $jadwal_keluar){
                    DB::table('tb_ruang')->where('id_ruang', $id_ruang)->update(['id_guru' => $id_guru, 'id_mapel' => $id_mapel, 'id_kelas' => $id_kelas, 'start' => $jadwal_masuk, 'end' => $jadwal_keluar]);

                    $isAbsensi = DB::table('tb_absensi')->where([['id_ruang', $id_ruang], ['start', $jadwal_masuk], ['end', $jadwal_keluar], ['tanggal', $tanggal]])->count();
                    info($isAbsensi);
                    if($isAbsensi == 0){
                        self::updateAbsensi($id_guru, $id_mapel, $id_kelas, $id_ruang, $tanggal, $jadwal_masuk, $jadwal_keluar);
                    }
                    break;
                }
            }
        }

        return 'success update ruang';
    }

    public static function updateAbsensi($id_guru, $id_mapel, $id_kelas, $id_ruang, $tanggal, $start, $end){
        info('controller AutomationController updateAbsensi ----------');

        $data = array();

        $dbMurid = DB::table('tb_murid')->where('id_kelas', $id_kelas)->get();
        if(count($dbMurid) == 0){
            return false;
        }

        foreach($dbMurid as $x){
            array_push($data, array('id_murid' => $x->id_murid, 'id_guru' => $id_guru, 'id_mapel' => $id_mapel, 'id_kelas' => $id_kelas, 'id_ruang' => $id_ruang, 'tanggal' => $tanggal, 'status' => 'Tidak Hadir', 'start' => $start, 'end' => $end, 'jam_masuk' => '', 'jam_keluar' => ''));
        }

        DB::table('tb_absensi')->insert($data);

        return true;
    }
}
