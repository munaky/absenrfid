<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AnyController;
use App\Models\AbsensiModel;
use App\Models\APIModel;
use App\Models\MuridModel;
use App\Models\KelasModel;
use App\Models\DaftarModel;
use App\Models\RuangModel;
use App\Models\JampelModel;

class GetDataController extends Controller
{
    //

    public static function getUsers(){
        info('controller GetDataController getUsersData ----------');

        $users = array();

        $dbUsers = DB::select('SELECT * FROM tb_users');

        foreach($dbUsers as $x){
            array_push($users, array('id_user' => $x->id_user, 'nama' => $x->nama, 'username' => $x->username, 'password' => $x->password, 'level' => $x->level));
        }

        return $users;
    }

    public static function getMurid($kelas){
        info('controller GetDataController getMurid ----------');

        $murid = array();
        $idKelas = '';

        $dbKelas = DB::table('tb_kelas')->where('kelas', 'LIKE', '%'.$kelas.'%')->get();
        if(count($dbKelas) == 0){
            return;
        }
        foreach($dbKelas as $x){
            $idKelas .= "'".$x->id_kelas."',";
        }

        $idKelas = substr($idKelas, 0, -1);

        $dbMurid = DB::select('SELECT * FROM tb_murid WHERE id_kelas IN ('.$idKelas.')');

        foreach($dbMurid as $x){
            $kelas = "?";

            foreach($dbKelas as $y){
                if($x->id_kelas == $y->id_kelas){
                    $kelas = $y->kelas;
                    break;
                }
            }

            array_push($murid, array('id_murid' => $x->id_murid, 'id_kartu' => $x->id_kartu, 'nama' => $x->nama, 'kelas' => $kelas));
        }

        return $murid;
    }

    public static function getGuru(){
        info('controller GetDataController getGuru ----------');

        $guru = array();

        $dbGuru = DB::select('SELECT * FROM tb_guru');
        $dbMapel = DB::select('SELECT * FROM tb_mapel');

        foreach($dbGuru as $x){
            $mapel = array();
            $id_mapel = explode('|', $x->id_mapel);

            foreach($id_mapel as $y){
                foreach($dbMapel as $z){
                    if($y == $z->id_mapel){
                        array_push($mapel, $z->mapel);
                        break;
                    }
                }
            }

            array_push($guru, array('id_guru' => $x->id_guru, 'nama' => $x->nama, 'mapel' => $mapel));
        }

        return $guru;
    }

    public static function getKelas(){
        info('controller GetDataController getKelas ----------');

        $kelas = array();

        $dbKelas = DB::select('SELECT * FROM tb_kelas');
        $dbGuru = DB::select('SELECT * FROM tb_guru');

        foreach($dbKelas as $x){
            $guru = "?";

            foreach($dbGuru as $y){
                if($x->id_guru == $y->id_guru){
                    $guru = $y->nama;
                    break;
                }
            }

            array_push($kelas, array('id_kelas' => $x->id_kelas, 'kelas' => $x->kelas, 'guru' => $guru));
        }

        return $kelas;
    }

    public static function  getMapel(){
        info('controller GetDataController getMapel ----------');

        $mapel = array();

        $dbMapel = DB::select('SELECT * FROM tb_mapel');

        foreach($dbMapel as $x){
            array_push($mapel, array('id_mapel' => $x->id_mapel, 'mapel' => $x->mapel));
        }

        return $mapel;
    }

    public static function getNamaRuang(){
        info('controller GetDataController getNamaRuang ----------');

        $ruang = array();

        $dbRuang = DB::table('tb_ruang')->get(['id_ruang', 'nama']);

        foreach($dbRuang as $x){
            array_push($ruang, array('id_ruang' => $x->id_ruang, 'nama' => $x->nama));
        }

        return $ruang;
    }

    public static function getJadwalRuang($id_ruang){
        info('controller GetDataController getJadwalRuang ----------');

        $jadwal = array();
        $jadwalPelajaran = array();

        $dbRuang = DB::table('tb_ruang')->where('id_ruang', $id_ruang)->get(['senin', 'selasa', 'rabu', 'kamis', 'jumat']);
        $dbGuru = DB::table('tb_guru')->get('*');
        $dbKelas = DB::table('tb_kelas')->get('*');
        $dbMapel = DB::table('tb_mapel')->get('*');

        foreach($dbRuang[0] as $x => $valx){
            $guru = "-";
            $mapel = "-";
            $kelas = "-";
            $jampel = array();
            $arrJampel = json_decode($valx, true);

            foreach($arrJampel as $y => $valy){
                foreach($dbGuru as $a){
                    if($arrJampel[$y]['id_guru'] == $a->id_guru){
                        $guru = $a->nama;
                    }
                }

                foreach($dbKelas as $a){
                    if($arrJampel[$y]['id_kelas'] == $a->id_kelas){
                        $kelas = $a->kelas;
                    }
                }

                foreach($dbMapel as $a){
                    if($arrJampel[$y]['id_mapel'] == $a->id_mapel){
                        $mapel = $a->mapel;
                    }
                }

                array_push($jampel, array('guru' => $guru, 'kelas' => $kelas, 'mapel' => $mapel));
            }

            $jadwal[$x] = $jampel;
        }

        for($x = 0; $x < 13; $x++){
            foreach($jadwal as $y => $valy){
                $jadwalPelajaran[$x][$y] = $valy[$x];
            }
        }

        return $jadwalPelajaran;
    }

    public static function getAbsensiRoom($ruang){
        info('controller GetDataController getAbsensiRoom ----------');

        $absensi = array();
        $murid = array();
        $nama_murid = '-';
        $totalHadir = 0;
        $totalTidakHadir = 0;
        $hari = AnyController::DayToHari(date('D'));
        $tanggal = date('Y/m/d');
        $guru = '-';
        $mapel = '-';
        $kelas = '-';
        $jadwal_masuk = '-';
        $jadwal_keluar = '-';
        $start = 0;
        $end = 0;

        $dbRuang = DB::table('tb_ruang')->where('nama', $ruang)->get(['id_ruang', 'id_guru', 'id_mapel', 'id_kelas', 'start', 'end']);
        if(count($dbRuang) == 1){
            $id_ruang = $dbRuang[0]->id_ruang;
            $id_guru = $dbRuang[0]->id_guru;
            $id_mapel = $dbRuang[0]->id_mapel;
            $id_kelas = $dbRuang[0]->id_kelas;
            $start = $dbRuang[0]->start;
            $end = $dbRuang[0]->end;
        }
        else{
            return false;
        }

        $dbGuru = DB::table('tb_guru')->where('id_guru', $id_guru)->get('nama');
        if(count($dbGuru) == 1){
            $guru = $dbGuru[0]->nama;
        }
        $dbMapel = DB::table('tb_mapel')->where('id_mapel', $id_mapel)->get('mapel');
        if(count($dbMapel) == 1){
            $mapel = $dbMapel[0]->mapel;
        }
        $dbKelas = DB::table('tb_kelas')->where('id_kelas', $id_kelas)->get('kelas');
        if(count($dbMapel) == 1){
            $kelas = $dbKelas[0]->kelas;
        }
        $dbJampel = DB::table('tb_jampel')->where('hari', $hari)->get([$start, $end]);
        if(count($dbJampel) == 1){
            $parseStart = json_decode($dbJampel[0]->$start);
            $jadwal_masuk = $parseStart->start;
            $parseEnd = json_decode($dbJampel[0]->$end);
            $jadwal_keluar = $parseEnd->end;
        }

        $dbAbsensi = DB::table('tb_absensi')->where([['id_ruang', $id_ruang], ['start', $start], ['end', $end], ['tanggal', $tanggal]])->get('*');
        if(count($dbAbsensi) == 0){
            info('dbAbsensi return false ----------');
            return false;
        }

        $listMurid = self::getMurid($kelas);
        foreach($dbAbsensi as $x){
            if($x->status == "Hadir"){
                $totalHadir ++;
            }
            else{
                $totalTidakHadir ++;
            }

            foreach($listMurid as $y){
                if($x->id_murid == $y['id_murid']){
                    $nama_murid = $y['nama'];
                }
            }

            array_push($murid, array('id_absensi' => $x->id_absensi, 'nama' => $nama_murid, 'kelas' => $kelas, 'tanggal' => $tanggal, 'status' => $x->status, 'jam_masuk' => $x->jam_masuk, 'jam_keluar' => $x->jam_keluar));
        }

        $absensi['ruang'] = $ruang;
        $absensi['guru'] = $guru;
        $absensi['mapel'] = $mapel;
        $absensi['kelas'] = $kelas;
        $absensi['durasi'] = "$start - $end ($jadwal_masuk - $jadwal_keluar)";
        $absensi['murid'] = $murid;
        $absensi['kehadiran'] = array('hadir' => $totalHadir, 'tidak_hadir' => $totalTidakHadir);

        return $absensi;
    }

    public static function getApi(){
        info('controller GetDataController getAPI ----------');

        return APIModel::with('api_mode')->get();;
    }

    public static function getJampelByHari($hari){
        info('controller GetDataController getJampelByHari ----------');

        $jampel = array();

        $dbJampel = DB::table('tb_jampel')->where('hari', $hari)->get();
        if(count($dbJampel) != 1){
            return false;
        }

        for($x = 1; $x < 14; $x++){
            $jampel["$x"] = json_decode($dbJampel[0]->$x, true);
        }

        return $jampel;
    }

    public static function getRuangByHari($hari){
        info('controller GetDataController getRuangByHari ----------');

        $ruang = array();

        $dbRuang = DB::table('tb_ruang')->get(['id_ruang', $hari, 'start', 'end']);
        if(count($dbRuang) == 0){
            return false;
        }

        foreach($dbRuang as $x){
            array_push($ruang, array('id_ruang' => $x->id_ruang, $hari => json_decode($x->$hari, true), 'start' => $x->start, 'end' => $x->end));
        }

        return $ruang;
    }

    public static function getAbsensiTerbaru($jumlah){
        info('controller GetDataController getAbsensiTerbaru ----------');

        $absensi = array();
        $listMurid = DB::table('tb_murid')->get();
        $listKelas = self::getKelas();
        $listMapel = self::getMapel();
        $listRuang = self::getNamaRuang();
        $dbAbsensi = DB::table('tb_absensi')->where('status', 'Hadir')->orderBy('jam_masuk', 'desc')->limit($jumlah)->get();
        if(count($dbAbsensi) == 0){
            return false;
        }

        foreach($dbAbsensi as $x){
            $nama = '-';
            $kelas = '-';
            $mapel = '-';
            $ruang = '-';

            foreach($listMurid as $y){
                if($x->id_murid == $y->id_murid){
                    $nama = $y->nama;
                    break;
                }
            }

            foreach($listKelas as $y){
                if($x->id_kelas == $y['id_kelas']){
                    $kelas = $y['kelas'];
                    break;
                }
            }

            foreach($listMapel as $y){
                if($x->id_mapel == $y['id_mapel']){
                    $mapel = $y['mapel'];
                    break;
                }
            }

            foreach($listRuang as $y){
                if($x->id_ruang == $y['id_ruang']){
                    $ruang = $y['nama'];
                    break;
                }
            }

            array_push($absensi, array('nama' => $nama, 'kelas' => $kelas, 'tanggal' => $x->tanggal, 'mapel' => $mapel, 'jam_masuk' => $x->jam_masuk, 'jam_keluar' => $x->jam_keluar, 'ruang' => $ruang));

        }

        return $absensi;
    }

    public static function detailRuangPure($id_ruang){
        info('controller APIGetController detailRuang ----------');

        $relations = ['guru', 'mapel', 'kelas'];

        $data = RuangModel::with($relations)->where('id_ruang', $id_ruang)->get(['nama', 'id_guru', 'id_mapel', 'id_kelas', 'start', 'end'])->first();
        $dateNow = date('Y/m/d');
        $day = AnyController::DayToHari(date('D'));
        $start = json_decode(JampelModel::where('hari', $day)->value($data->start));
        $end = json_decode(JampelModel::where('hari', $day)->value($data->end));
        $data['durasi'] = $data->start . ' - ' . $data->end . ' ( ' . $start->start . ' - ' . $end->end . ' )';
        $data['hadir'] = AbsensiModel::where([['id_guru', $data->id_guru], ['id_mapel', $data->id_mapel], ['id_kelas', $data->id_kelas], ['id_ruang', $id_ruang], ['tanggal', $dateNow], ['start', $data->start], ['end', $data->end], ['status', 'Hadir']])->count();
        $data['tidak_hadir'] = AbsensiModel::where([['id_guru', $data->id_guru], ['id_mapel', $data->id_mapel], ['id_kelas', $data->id_kelas], ['id_ruang', $id_ruang], ['tanggal', $dateNow], ['start', $data->start], ['end', $data->end], ['status', 'Tidak Hadir']])->count();

        return $data;
    }

    public static function newestAbsensi($amount){
        info('controller APIGetController newestAbsensi ----------');

        return AbsensiModel::with(['murid.kelas', 'guru', 'mapel', 'ruang' => function ($query) {
            $query->select('id_ruang', 'nama');
        }])->where([['jam_masuk', '!=', ''], ['status', 'Hadir']])->orderBy('jam_masuk', 'desc')->limit($amount)->get();
    }
}
